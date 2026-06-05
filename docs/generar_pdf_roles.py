"""Genera PDF de la guía de roles del equipo The-grup."""
from pathlib import Path

from fpdf import FPDF

ROOT = Path(__file__).resolve().parent.parent
OUTPUT = ROOT / "docs" / "guia-roles-equipo.pdf"
FONT = Path("C:/Windows/Fonts/arial.ttf")
FONT_BOLD = Path("C:/Windows/Fonts/arialbd.ttf")

TEAM = [
    ("Verenice", "Líder y desarrolladora principal", "Backend MVC, lógica, coordinación"),
    ("Jessica", "Frontend y responsive", "Diseño visual, UI/UX, móvil"),
    ("Yadira", "Documentacion y presentacion", "Manuales, capturas, diapositivas"),
    ("Yadira", "Coordinacion de entregables academicos", "Checklist entrega, indice docs, paquete final"),
    ("Elda", "Validaciones", "Pruebas, formularios, checklist seguridad"),
    ("Adrian", "GitHub y organizacion", "Repo, ramas, README, releases"),
    ("Adrian", "Revision e integracion de codigo", "Revisar PRs, merges, arquitectura MVC"),
]

FOLDERS = [
    ("app/ (raíz)", "Verenice", "Jessica, Yadira, Elda, Adrian", "Coordinación e integración general"),
    ("config/", "Verenice", "Adrian, Elda", "Configuración, .env, BD, WhatsApp"),
    ("controllers/", "Verenice", "Adrian, Elda", "Factory, blueprints, rutas HTTP"),
    ("controllers/auth/", "Verenice", "Jessica, Elda, Yadira, Adrian", "Login, registro, logout"),
    ("controllers/catalog/", "Verenice", "Jessica, Elda, Yadira, Adrian", "Página principal, productos activos"),
    ("controllers/dashboard/", "Verenice", "Jessica, Elda, Yadira, Adrian", "Panel admin protegido"),
    ("controllers/products/", "Verenice", "Jessica, Elda, Yadira, Adrian", "CRUD productos admin"),
    ("models/", "Verenice", "Elda, Yadira, Adrian", "User, Product, persistencia"),
    ("views/", "Verenice + Jessica", "Yadira, Elda, Adrian", "Plantillas HTML Jinja2"),
    ("views/layouts/", "Verenice + Jessica", "Yadira, Elda, Adrian", "Base responsive, navbar"),
    ("views/auth/", "Jessica", "Verenice, Elda, Yadira, Adrian", "Formularios login/registro"),
    ("views/catalog/", "Jessica", "Verenice, Elda, Yadira, Adrian", "Grid catálogo, botón Comprar"),
    ("views/dashboard/", "Jessica", "Verenice, Yadira, Elda, Adrian", "Panel administrativo"),
    ("views/products/", "Jessica", "Verenice, Elda, Yadira, Adrian", "Tablas y formularios CRUD"),
    ("static/", "Jessica", "Verenice, Yadira, Elda, Adrian", "CSS, JS, imágenes"),
    ("static/css/", "Jessica", "Verenice, Elda, Yadira, Adrian", "Estilos responsive"),
    ("static/js/", "Jessica", "Verenice, Elda, Adrian", "UX frontend sin lógica de negocio"),
    ("static/img/", "Jessica", "Yadira, Verenice, Adrian", "Logo, placeholders, favicon"),
    ("utils/", "Verenice", "Elda, Jessica, Adrian", "WhatsApp, decoradores, validadores"),
    ("tests/", "Elda", "Verenice, Adrian, Yadira", "Suite unitaria y funcional"),
    ("tests/unit/", "Elda + Verenice", "Adrian, Yadira", "Modelos, utils, WhatsApp"),
    ("tests/functional/", "Elda + Verenice", "Adrian, Yadira, Jessica", "Flujos E2E HTTP"),
]

STAGES = [
    ("1 — Esqueleto MVC", "Verenice", "Jessica, Adrian"),
    ("2 — Modelos", "Verenice", "Elda, Adrian"),
    ("3 — Auth", "Verenice", "Jessica, Elda, Yadira, Adrian"),
    ("4 — Dashboard", "Verenice", "Jessica, Yadira, Elda"),
    ("5 — CRUD productos", "Verenice", "Jessica, Elda, Yadira"),
    ("6 — Catálogo + WhatsApp", "Verenice", "Jessica, Elda, Yadira"),
    ("7 — Cierre", "Todos", "Elda valida, Yadira docs, Adrian release"),
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
        self.cell(0, 10, title, ln=True, fill=True)
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
    pdf.cell(0, 15, "The-grup", ln=True, align="C")
    pdf.set_font("Arial", "B", 16)
    pdf.cell(0, 10, "Guia de Roles del Equipo", ln=True, align="C")
    pdf.set_font("Arial", "", 11)
    pdf.cell(0, 8, "Catalogo de productos + WhatsApp | Python MVC", ln=True, align="C")
    pdf.ln(10)
    pdf.body_text(
        "Documento de distribucion interna. Define responsabilidades de los 5 integrantes "
        "en cada carpeta del proyecto y el orden de trabajo por etapas."
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
            "Arquitectura MVC: controllers/, models/, config/",
            "Login, registro, dashboard, CRUD productos",
            "Generacion enlace WhatsApp (utils/)",
            "Coordinacion e integracion del equipo",
        ],
        "Jessica - Frontend y responsive": [
            "static/css/, static/js/, static/img/",
            "views/: layouts, auth, catalog, dashboard, products",
            "Diseno responsive mobile-first",
            "Boton Comprar visible en cada tarjeta",
        ],
        "Yadira - Documentacion y presentacion": [
            "Manual de usuario y manual tecnico (docs/)",
            "Capturas desktop y movil de todas las pantallas",
            "Diapositivas: objetivo, arquitectura, demo, equipo",
            "Glosario MVC, blueprint, WhatsApp wa.me",
        ],
        "Yadira - Coordinacion de entregables academicos": [
            "Checklist de entregables por integrante",
            "Indice de documentos en docs/",
            "Paquete final en docs/entrega/ para exposicion",
            "Verificar material completo antes de fecha de entrega",
        ],
        "Elda - Validaciones": [
            "Matriz de 12 pruebas obligatorias",
            "tests/unit/ y tests/functional/",
            "Revision formularios auth y productos",
            "Checklist de seguridad por etapa",
        ],
        "Adrian - GitHub y organizacion": [
            "Estructura spec/, skill/, app/",
            "README, .gitignore, requirements.txt",
            "Ramas, PRs y tag de entrega v1.0.0",
            "Verificar que no se commiteen secretos",
        ],
        "Adrian - Revision e integracion de codigo": [
            "Revisar pull requests del equipo",
            "Coordinar merges a main sin conflictos",
            "Validar que cambios respeten arquitectura MVC",
            "Coordinar con Elda que tests pasen antes de merge",
        ],
    }
    for title, items in details.items():
        pdf.set_font("Arial", "B", 11)
        pdf.cell(0, 7, title, ln=True)
        pdf.set_font("Arial", "", 9)
        for item in items:
            pdf.cell(0, 6, f"  - {item}", ln=True)
        pdf.ln(2)

    pdf.add_page()
    pdf.section_title("3. Asignacion por carpeta (app/)")
    w2 = [42, 28, 50, 70]
    pdf.table_header(["Carpeta", "Principal", "Apoyo", "Tarea clave"], w2)
    for row in FOLDERS:
        pdf.table_row(row, w2, bold_first=True)

    pdf.ln(6)
    pdf.section_title("4. Cronograma por etapas")
    w3 = [45, 40, 105]
    pdf.table_header(["Etapa", "Responsable", "Apoyos"], w3)
    for row in STAGES:
        pdf.table_row(row, w3, bold_first=True)

    pdf.ln(6)
    pdf.section_title("5. Flujo de trabajo")
    pdf.body_text(
        "Verenice desarrolla logica -> Jessica estiliza vistas -> Elda valida build estable -> "
        "Yadira documenta con capturas -> Adrian hace merge y release en GitHub."
    )
    pdf.body_text(
        "Reglas: (1) Una persona, un dominio principal. (2) Avisar antes de mergear. "
        "(3) No commitear .env. (4) Bugs con pasos y captura. (5) Respetar MVC."
    )

    pdf.section_title("6. Escalacion")
    w4 = [70, 120]
    pdf.table_header(["Situacion", "Contactar"], w4)
    escalations = [
        ("Error ruta, BD o login", "Verenice"),
        ("Problemas visuales o movil", "Jessica"),
        ("Manual, slides o capturas", "Yadira"),
        ("Algo no funciona al probar", "Elda -> Verenice"),
        ("Git, ramas o estructura", "Adrian"),
        ("Bloqueo general", "Verenice (lider)"),
    ]
    for row in escalations:
        pdf.table_row(row, w4)

    pdf.ln(8)
    pdf.set_font("Arial", "I", 8)
    pdf.cell(0, 6, "Generado para The-grup | spec/001-catalogo-productos-whatsapp.md", align="C")

    OUTPUT.parent.mkdir(parents=True, exist_ok=True)
    pdf.output(str(OUTPUT))
    print(f"PDF generado: {OUTPUT}")


if __name__ == "__main__":
    build_pdf()
