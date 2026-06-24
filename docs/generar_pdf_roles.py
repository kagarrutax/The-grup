"""Genera PDF de la guía de roles del equipo The-grup."""
from pathlib import Path

from fpdf import FPDF

ROOT = Path(__file__).resolve().parent.parent
OUTPUT = ROOT / "docs" / "guia-roles-equipo.pdf"
FONT = Path("C:/Windows/Fonts/arial.ttf")
FONT_BOLD = Path("C:/Windows/Fonts/arialbd.ttf")

TEAM = [
    ("Verenice", "Lider y desarrolladora principal", "Laravel MVC, modelos, controladores, stock"),
    ("Jessica", "Frontend y responsive", "Blade, Bootstrap 5, vistas responsive"),
    ("Yadira", "Documentacion y presentacion", "Manuales, capturas, diapositivas"),
    ("Yadira", "Coordinacion de entregables academicos", "Checklist entrega, paquete final"),
    ("Elda", "Validaciones", "php artisan test, casos stock limite"),
    ("Adrian", "GitHub y organizacion", "Repo, ramas, README, Railway"),
    ("Adrian", "Revision e integracion de codigo", "Revisar PRs, merges, tests en verde"),
]

FOLDERS = [
    ("app/ (raiz Laravel)", "Verenice", "Adrian, Yadira", "Instalacion, Breeze, .env MySQL"),
    ("app/Http/Controllers/", "Verenice", "Adrian, Yadira", "Category, Product, Stock, Dashboard"),
    ("app/Models/", "Verenice", "Adrian, Yadira", "User, Category, Product, StockMovement"),
    ("database/migrations/", "Verenice", "Adrian, Yadira", "Esquema MySQL"),
    ("database/seeders/", "Verenice", "Adrian, Yadira", "Admin demo, categorias, productos"),
    ("routes/", "Verenice", "Adrian", "web.php resources + dashboard"),
    ("resources/views/", "Jessica", "Adrian, Yadira", "Todas las vistas Blade"),
    ("resources/views/layouts/", "Jessica", "Adrian, Yadira", "app.blade.php Bootstrap"),
    ("resources/views/categories/", "Jessica", "Adrian, Yadira", "CRUD categorias"),
    ("resources/views/products/", "Jessica", "Adrian, Yadira", "CRUD + buscador"),
    ("resources/views/stock/", "Jessica", "Adrian, Yadira", "Movimientos entrada/salida"),
    ("resources/views/dashboard/", "Jessica", "Adrian, Yadira", "Panel metricas"),
    ("tests/", "Elda", "Adrian, Verenice", "Feature y Unit tests"),
    ("docs/", "Yadira", "Adrian, Verenice", "Manuales, capturas, slides"),
]

STAGES = [
    ("1 Instalacion", "Verenice", "Jessica layout, Adrian repo"),
    ("2 Categorias", "Verenice", "Jessica vistas, Elda tests"),
    ("3 Productos", "Verenice", "Jessica vistas, Elda SKU"),
    ("4 Stock", "Verenice", "Jessica vistas, Elda casos limite"),
    ("5 Dashboard", "Verenice", "Jessica vistas, Yadira capturas"),
    ("6 Buscador", "Verenice", "Jessica form, Elda filtros"),
]


class RolesPDF(FPDF):
    def __init__(self):
        super().__init__()
        self.add_font("Arial", "", str(FONT))
        self.add_font("Arial", "B", str(FONT_BOLD))
        self.set_auto_page_break(auto=True, margin=20)

    def section_title(self, title: str):
        self.set_font("Arial", "B", 14)
        self.set_fill_color(41, 98, 255)
        self.set_text_color(255, 255, 255)
        self.cell(0, 10, title, new_x="LMARGIN", new_y="NEXT", fill=True)
        self.set_text_color(0, 0, 0)
        self.ln(4)

    def body_text(self, text: str):
        self.set_font("Arial", "", 10)
        self.multi_cell(0, 6, text)
        self.ln(2)

    def table_header(self, cols, widths):
        self.set_font("Arial", "B", 9)
        self.set_fill_color(230, 236, 245)
        for i, col in enumerate(cols):
            self.cell(widths[i], 8, col, border=1, fill=True)
        self.ln()

    def table_row(self, cols, widths, bold_first=False):
        self.set_font("Arial", "B" if bold_first else "", 8)
        for i, col in enumerate(cols):
            self.cell(widths[i], 7, col[:80], border=1)
        self.ln()


def build_pdf():
    pdf = RolesPDF()
    pdf.add_page()

    pdf.set_font("Arial", "B", 22)
    pdf.cell(0, 15, "The-grup", new_x="LMARGIN", new_y="NEXT", align="C")
    pdf.set_font("Arial", "B", 16)
    pdf.cell(0, 10, "Guia de Roles del Equipo", new_x="LMARGIN", new_y="NEXT", align="C")
    pdf.set_font("Arial", "", 11)
    pdf.cell(0, 8, "Inventario Supermercado | Laravel 11 + MySQL", new_x="LMARGIN", new_y="NEXT", align="C")
    pdf.ln(10)
    pdf.body_text(
        "Sistema de inventario: categorias, productos, movimientos de stock, dashboard y buscador. "
        "Mismos 5 integrantes, nueva arquitectura Laravel MVC."
    )

    pdf.section_title("1. Integrantes del equipo")
    w = [35, 55, 100]
    pdf.table_header(["Integrante", "Rol", "Enfoque principal"], w)
    for row in TEAM:
        pdf.table_row(row, w, bold_first=True)

    pdf.ln(6)
    pdf.section_title("2. Responsabilidades por integrante")

    details = {
        "Verenice - Lider y desarrolladora principal": [
            "Laravel 11, Breeze, migraciones MySQL",
            "Controllers: Category, Product, Stock, Dashboard",
            "Logica stock: validar no negativo en salidas",
            "Seeder admin@supermercado.com",
        ],
        "Jessica - Frontend y responsive": [
            "resources/views/ Blade + Bootstrap 5 CDN",
            "Layout app.blade.php responsive",
            "Vistas CRUD y formulario buscador",
        ],
        "Yadira - Documentacion y presentacion": [
            "README instalacion y credenciales demo",
            "Capturas dashboard, stock, productos, movil",
            "Slides exposicion clase",
        ],
        "Yadira - Coordinacion de entregables academicos": [
            "Checklist entregables por integrante",
            "Paquete docs/entrega/",
        ],
        "Elda - Validaciones": [
            "php artisan test Feature y Unit",
            "Caso critico: salida > stock disponible",
            "SKU duplicado, buscador, auth",
        ],
        "Adrian - GitHub y organizacion": [
            "Ramas feat/categories, feat/stock, etc.",
            "README, .gitignore, tag v1.0.0",
            "Despliegue Railway documentado",
        ],
        "Adrian - Revision e integracion de codigo": [
            "Revisar PRs antes de merge",
            "Tests en verde obligatorio",
        ],
    }
    for title, items in details.items():
        pdf.set_font("Arial", "B", 11)
        pdf.cell(0, 7, title, new_x="LMARGIN", new_y="NEXT")
        pdf.set_font("Arial", "", 9)
        for item in items:
            pdf.cell(0, 6, f"  - {item}", new_x="LMARGIN", new_y="NEXT")
        pdf.ln(2)

    pdf.add_page()
    pdf.section_title("3. Asignacion por carpeta")
    w2 = [42, 28, 50, 70]
    pdf.table_header(["Carpeta", "Encargado", "Apoyo", "Tarea clave"], w2)
    for row in FOLDERS:
        pdf.table_row(row, w2, bold_first=True)

    pdf.ln(6)
    pdf.section_title("4. Cronograma (6 fases)")
    w3 = [45, 40, 105]
    pdf.table_header(["Fase", "Responsable", "Apoyos"], w3)
    for row in STAGES:
        pdf.table_row(row, w3, bold_first=True)

    pdf.ln(6)
    pdf.section_title("5. Credenciales demo")
    pdf.body_text("Email: admin@supermercado.com | Password: password")

    pdf.ln(4)
    pdf.set_font("Arial", "I", 8)
    pdf.cell(0, 6, "The-grup | spec/001-inventario-supermercado.md", align="C")

    OUTPUT.parent.mkdir(parents=True, exist_ok=True)
    pdf.output(str(OUTPUT))
    print(f"PDF generado: {OUTPUT}")


if __name__ == "__main__":
    build_pdf()
