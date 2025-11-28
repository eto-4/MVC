# Requisits Funcionals
## 1. Estructura MVC
 - Model: Classe Tasca per gestionar les dades i la lògica de negoci
 - Vista: Plantilles PHP per a la presentació (header, footer, formularis, llistats)
 - Controlador: Classes HomeController i TaskController per gestionar la lògica de control
## 2. Sistema de Routing
 - Implementar un Router personalitzat que gestioni les rutes de l'aplicació
 - Suport per a rutes dinàmiques amb paràmetres (ex: /tasques/{id})
 - Gestió d'errors 404
 - Configuració automàtica del basePath
## 3. Operacions CRUD per Tasques
 - CREATE: Formulari per crear noves tasques
 - READ: Llistat de totes les tasques i visualització individual
 - UPDATE: Formulari per editar tasques existents
 - DELETE: Eliminació de tasques amb confirmació

## 4. Base de Dades
 - Connexió a MySQL utilitzant PDO
 - Implementar el patró Singleton per a la connexió
 - Taula tasques amb camps: id, nom
 - Gestió d’errors amb try - catch
## 5. Sistema de Missatges Flash
 - Implementar una classe FlashMessages per mostrar notificacions
 - Suport per diferents tipus: success, error, warning, info
 - Integració amb Bootstrap per a l'estil
## 6. Validator
 - Classe Validator amb tota la lògica per a la validació de dades tant en formularis com en paràmetres GET, i  sempre que sigui necessari

# Requisits Tècnics
## Estructura de Carpetes
/
├── config/
│   └── Database.php
├── controllers/
│   ├── HomeController.php
│   └── TaskController.php
├── models/
│   └── Tasca.php
├── views/
│   ├── layouts/
│   │   ├── header.php
│   │   └── footer.php
│   ├── home/
│   │   ├── index.php
│   │   └── 404.php
│   └── tasques/
│       ├── index.php
│       ├── create.php
│       └── edit.php
├── helpers/
│   └── FlashMessages.php
│   └── Validator.php
├── assets/
│   └── css/
│       └── style.css
├── .htaccess
├── Router.php
└── index.php

# Rutes a Implementar
 - GET / - Pàgina principal
 - GET /tasques - Llistat de tasques
 - GET /tasques/create - Formulari de creació
 - POST /tasques - Processar creació
 - GET /tasques/{id}/edit - Formulari d'edició
 - POST /tasques/{id} - Processar actualització
 - POST /tasques/{id}/delete - Eliminar tasca

# Interfície d'Usuari
 - Utilitzar Bootstrap 5 per a l'estil
 - Disseny responsive i modern
 - Navegació amb breadcrumbs
 - Confirmacions JavaScript per eliminacions
 - Missatges flash per a feedback d'usuari

# Aspectes de Disseny
 - Paleta de colors coherent
 - Ús d'icones Bootstrap Icons
 - Animacions CSS suaus
 - Empty states quan no hi ha dades
 - Footer fix al bottom de la pàgina
# Entregables
 - Codi font complet seguint l'estructura MVC connexió Singleton a la BBDD i validació en tots els formularis. 
 - Base de dades MySQL amb la taula corresponent
 - Fitxer .htaccess configurat per al routing
 - Documentació del codi amb comentaris
 - Aplicació funcional amb totes les operacions CRUD
 - Vídeo demostratiu