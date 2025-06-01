# Proyecto Capachica - Backend

Este repositorio contiene el backend del proyecto Capachica, orientado al desarrollo de un sistema de gestión de turismo para la localidad de Capachica.

Incluye:
- Pruebas unitarias e integración
- Análisis de calidad de código con SonarQube
- Integración continua con GitHub Actions

---

## 1. Requisitos

- Docker y Docker Compose
- PHP 8.1+
- Composer
- Node.js (opcional)
- Acceso a SonarQube (local o remoto)

---

## 2. Instalación del Proyecto

```bash
git clone https://github.com/usuario/capachica-backend.git
cd capachica-backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
```

---

## 3. Ejecutar Pruebas

```bash
php artisan test
# o
vendor/bin/phpunit --coverage-clover coverage.xml
```

---

## 4. Análisis de Calidad con SonarQube

### Opciones:

#### A. Vía GitHub Actions (Recomendado)
Ya configurado con `.github/workflows/sonar.yml`.
Push a main activa el escaneo automáticamente.

#### B. Vía SonarScanner manual:
```bash
sonar-scanner
```
Asegúrate de tener un archivo sonar-project.properties.

---

## 5. Postman - Pruebas de Integración

Exporta la colección desde Postman y ejecútala con:
```bash
newman run docs/pruebas-postman.json
```

---

## 6. Documentación de Comandos y Resultados

Ver carpeta docs/:
- comandos.md: comandos utilizados
- resultados-sonarqube.png/pdf: capturas de análisis
- pruebas-postman.json: colección exportada

---

## 7. Base de Datos

- MySQL 5.7 o superior
- Ver configuración en .env

---

## 8. Autor

Este trabajo fue realizado como parte del curso de Verificación y Validación del Software. Integrante: [Tu Nombre]

---

## 9. Recursos

- SonarQube: http://localhost:9000/
- Laravel Docs: https://laravel.com/docs
- GitHub Actions: https://docs.github.com/actions
