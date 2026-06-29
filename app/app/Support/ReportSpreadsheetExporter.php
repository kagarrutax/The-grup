<?php

namespace App\Support;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ReportSpreadsheetExporter
{
    public static function download(string $fileName, Collection $rows, array $filters = []): Response
    {
        $content = self::make($rows, $filters);

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
            'Cache-Control' => 'max-age=0, no-cache, no-store, must-revalidate',
        ]);
    }

    public static function make(Collection $rows, array $filters = []): string
    {
        $lines = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<?mso-application progid="Excel.Sheet"?>',
            '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"',
            ' xmlns:o="urn:schemas-microsoft-com:office:office"',
            ' xmlns:x="urn:schemas-microsoft-com:office:excel"',
            ' xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"',
            ' xmlns:html="http://www.w3.org/TR/REC-html40">',
            ' <Styles>',
            '  <Style ss:ID="Default" ss:Name="Normal">',
            '   <Alignment ss:Vertical="Center"/>',
            '   <Borders/>',
            '   <Font ss:FontName="Calibri" ss:Size="11"/>',
            '   <Interior/>',
            '   <NumberFormat/>',
            '   <Protection/>',
            '  </Style>',
            '  <Style ss:ID="Title">',
            '   <Font ss:Bold="1" ss:Size="14"/>',
            '  </Style>',
            '  <Style ss:ID="Meta">',
            '   <Font ss:Color="#667085" ss:Size="10"/>',
            '  </Style>',
            '  <Style ss:ID="Header">',
            '   <Font ss:Bold="1" ss:Color="#FFFFFF"/>',
            '   <Interior ss:Color="#5E46F4" ss:Pattern="Solid"/>',
            '  </Style>',
            ' </Styles>',
            ' <Worksheet ss:Name="Reportes">',
            '  <Table>',
            '   <Column ss:Width="110"/>',
            '   <Column ss:Width="170"/>',
            '   <Column ss:Width="55"/>',
            '   <Column ss:Width="95"/>',
            '   <Column ss:Width="120"/>',
            '   <Column ss:Width="140"/>',
            '   <Column ss:Width="75"/>',
            '   <Column ss:Width="65"/>',
            '   <Column ss:Width="120"/>',
            '   <Column ss:Width="160"/>',
            self::row([
                ['Reporte de inventario', 'String', 'Title'],
            ]),
            self::row([
                ['Generado el '.now()->format('d/m/Y H:i'), 'String', 'Meta'],
            ]),
        ];

        $filterSummary = self::buildFilterSummary($filters);

        if ($filterSummary !== '') {
            $lines[] = self::row([
                [$filterSummary, 'String', 'Meta'],
            ]);
        }

        $lines[] = self::row([
            ['Fecha', 'String', 'Header'],
            ['Producto', 'String', 'Header'],
            ['ID', 'String', 'Header'],
            ['Código', 'String', 'Header'],
            ['Categoría', 'String', 'Header'],
            ['Proveedor', 'String', 'Header'],
            ['Tipo', 'String', 'Header'],
            ['Cantidad', 'String', 'Header'],
            ['Usuario', 'String', 'Header'],
            ['Motivo', 'String', 'Header'],
        ]);

        foreach ($rows as $row) {
            $lines[] = self::row([
                [$row['date'] ?? '—'],
                [$row['product'] ?? '—'],
                [(string) ($row['product_id'] ?? '—')],
                [$row['code'] ?? '—'],
                [$row['category'] ?? '—'],
                [$row['supplier'] ?? '—'],
                [$row['type'] ?? '—'],
                [(string) ($row['quantity'] ?? '0')],
                [$row['user'] ?? '—'],
                [$row['reason'] ?? '—'],
            ]);
        }

        if ($rows->isEmpty()) {
            $lines[] = self::row([
                ['No hay registros para los filtros seleccionados.'],
            ]);
        }

        $lines[] = '  </Table>';
        $lines[] = ' </Worksheet>';
        $lines[] = '</Workbook>';

        return implode("\n", $lines);
    }

    private static function row(array $cells): string
    {
        $xml = '   <Row>';

        foreach ($cells as $cell) {
            [$value, $type, $style] = array_pad($cell, 3, null);
            $cellType = $type ?: 'String';
            $styleXml = $style ? ' ss:StyleID="'.$style.'"' : '';
            $xml .= '<Cell'.$styleXml.'><Data ss:Type="'.$cellType.'">'.self::escape((string) $value).'</Data></Cell>';
        }

        $xml .= '</Row>';

        return $xml;
    }

    private static function buildFilterSummary(array $filters): string
    {
        $summary = [];

        if (! empty($filters['date_from'])) {
            $summary[] = 'Desde: '.$filters['date_from'];
        }

        if (! empty($filters['date_to'])) {
            $summary[] = 'Hasta: '.$filters['date_to'];
        }

        if (! empty($filters['category_name'])) {
            $summary[] = 'Categoría: '.$filters['category_name'];
        }

        if (! empty($filters['product_name'])) {
            $summary[] = 'Producto: '.$filters['product_name'];
        }

        if (! empty($filters['supplier_name'])) {
            $summary[] = 'Proveedor: '.$filters['supplier_name'];
        }

        return implode(' | ', $summary);
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
