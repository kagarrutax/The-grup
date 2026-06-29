<?php

namespace App\Support;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ReportPdfExporter
{
    public static function download(string $fileName, Collection $rows, array $filters = []): Response
    {
        $content = self::make($rows, $filters);

        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
            'Cache-Control' => 'max-age=0, no-cache, no-store, must-revalidate',
        ]);
    }

    public static function make(Collection $rows, array $filters = []): string
    {
        $pages = self::paginate(self::buildLines($rows, $filters));
        $objects = [];
        $kids = [];
        $fontObjectNumber = 3 + (count($pages) * 2);

        $objects[1] = '<< /Type /Catalog /Pages 2 0 R >>';

        foreach ($pages as $index => $pageLines) {
            $pageObjectNumber = 3 + ($index * 2);
            $contentObjectNumber = $pageObjectNumber + 1;

            $kids[] = $pageObjectNumber.' 0 R';

            $stream = self::buildPageStream($pageLines);

            $objects[$pageObjectNumber] = '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 '.$fontObjectNumber.' 0 R >> >> /Contents '.$contentObjectNumber.' 0 R >>';
            $objects[$contentObjectNumber] = "<< /Length ".strlen($stream)." >>\nstream\n".$stream."\nendstream";
        }

        $objects[2] = '<< /Type /Pages /Count '.count($pages).' /Kids [ '.implode(' ', $kids).' ] >>';
        $objects[$fontObjectNumber] = '<< /Type /Font /Subtype /Type1 /BaseFont /Courier /Encoding /WinAnsiEncoding >>';

        ksort($objects);

        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objects as $number => $body) {
            $offsets[$number] = strlen($pdf);
            $pdf .= $number." 0 obj\n".$body."\nendobj\n";
        }

        $xrefPosition = strlen($pdf);
        $pdf .= "xref\n0 ".(max(array_keys($objects)) + 1)."\n";
        $pdf .= "0000000000 65535 f \n";

        for ($i = 1; $i <= max(array_keys($objects)); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size ".(max(array_keys($objects)) + 1)." /Root 1 0 R >>\n";
        $pdf .= "startxref\n".$xrefPosition."\n%%EOF";

        return $pdf;
    }

    private static function buildLines(Collection $rows, array $filters): array
    {
        $lines = [
            'Reporte de inventario',
            'Generado el '.now()->format('d/m/Y H:i'),
        ];

        $filterSummary = self::buildFilterSummary($filters);

        if ($filterSummary !== '') {
            $lines = array_merge($lines, self::wrapLine('Filtros: '.$filterSummary));
        }

        $lines[] = '';

        if ($rows->isEmpty()) {
            $lines[] = 'No hay registros para los filtros seleccionados.';

            return $lines;
        }

        foreach ($rows as $row) {
            $lines = array_merge($lines, self::wrapLine('Fecha: '.($row['date'] ?? '—').' | Producto: '.($row['product'] ?? '—').' | Tipo: '.($row['type'] ?? '—')));
            $lines = array_merge($lines, self::wrapLine('ID: #'.($row['product_id'] ?? '—').' | Codigo: '.($row['code'] ?? '—').' | Cantidad: '.($row['quantity'] ?? '0').' | Usuario: '.($row['user'] ?? '—')));
            $lines = array_merge($lines, self::wrapLine('Categoria: '.($row['category'] ?? '—').' | Proveedor: '.($row['supplier'] ?? '—')));
            $lines = array_merge($lines, self::wrapLine('Motivo: '.($row['reason'] ?? '—')));
            $lines[] = str_repeat('-', 86);
        }

        return $lines;
    }

    private static function buildFilterSummary(array $filters): string
    {
        $summary = [];

        if (! empty($filters['date_from'])) {
            $summary[] = 'Desde '.$filters['date_from'];
        }

        if (! empty($filters['date_to'])) {
            $summary[] = 'Hasta '.$filters['date_to'];
        }

        if (! empty($filters['category_name'])) {
            $summary[] = 'Categoría '.$filters['category_name'];
        }

        if (! empty($filters['product_name'])) {
            $summary[] = 'Producto '.$filters['product_name'];
        }

        if (! empty($filters['supplier_name'])) {
            $summary[] = 'Proveedor '.$filters['supplier_name'];
        }

        return implode(' | ', $summary);
    }

    private static function wrapLine(string $line, int $width = 88): array
    {
        $wrapped = wordwrap($line, $width, "\n", true);

        return explode("\n", $wrapped);
    }

    private static function paginate(array $lines, int $maxLinesPerPage = 48): array
    {
        $pages = array_chunk($lines, $maxLinesPerPage);

        return $pages === [] ? [['Sin contenido']] : $pages;
    }

    private static function buildPageStream(array $lines): string
    {
        $commands = [
            'BT',
            '/F1 10 Tf',
            '14 TL',
            '40 800 Td',
        ];

        foreach (array_values($lines) as $index => $line) {
            $encoded = self::escapePdfText($line);

            if ($index === 0) {
                $commands[] = '('.$encoded.') Tj';
                continue;
            }

            $commands[] = 'T* ('.$encoded.') Tj';
        }

        $commands[] = 'ET';

        return implode("\n", $commands);
    }

    private static function escapePdfText(string $text): string
    {
        $encoded = iconv('UTF-8', 'Windows-1252//TRANSLIT//IGNORE', $text);
        $encoded = $encoded === false ? $text : $encoded;

        return str_replace(
            ['\\', '(', ')'],
            ['\\\\', '\\(', '\\)'],
            $encoded
        );
    }
}
