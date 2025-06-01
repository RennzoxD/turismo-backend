pipeline {
    agent any

    environment {
        // Token de SonarQube (defínelo en las credenciales de Jenkins)
        SONAR_TOKEN = credentials('squ_1c61596917c6839b64cc5961afad898ba25e54b4')
        // URL de SonarQube (ajusta si no es localhost)
        SONAR_HOST = 'http://localhost:9000'
    }

    stages {
        stage('Checkout') {
            steps {
                // Clona tu repo; asume que Jenkins está configurado con las credenciales adecuadas
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                // Instala Composer si no está en PATH o usa contenedor que lo tenga
                sh 'composer install --no-interaction --no-progress --prefer-dist'
            }
        }

        stage('Run PHPUnit Tests') {
            steps {
                // Ejecuta PHPUnit con coverage
                sh 'php -d xdebug.mode=coverage ./vendor/bin/phpunit --coverage-clover=coverage.xml'
            }
            post {
                always {
                    // Archiva el reporte de cobertura.xml para luego pasarlo a SonarQube
                    archiveArtifacts artifacts: 'coverage.xml', fingerprint: true
                    // Publica el reporte de pruebas JUnit (si PHPUnit genera un XML; no es obligatorio)
                    junit 'build/phpunit/*.xml'
                }
            }
        }

        stage('SonarQube Analysis') {
            steps {
                // Descarga SonarScanner CLI en cada build (alternativa a instalarlo globalmente)
                sh '''
                    curl -sSLo sonar-scanner.zip https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.7.0.2747-linux.zip
                    unzip -q sonar-scanner.zip
                    export PATH="${WORKSPACE}/sonar-scanner-4.7.0.2747-linux/bin:$PATH"
                '''

                // Ejecuta el análisis usando el coverage.xml generado
                sh """
                    sonar-scanner \
                      -Dsonar.projectKey=turismo-backend \
                      -Dsonar.sources=. \
                      -Dsonar.tests=tests \
                      -Dsonar.php.coverage.reportPaths=coverage.xml \
                      -Dsonar.host.url=${SONAR_HOST} \
                      -Dsonar.login=${SONAR_TOKEN}
                """
            }
        }
    }

    post {
        success {
            echo 'Build, tests y SonarQube completados con éxito.'
        }
        failure {
            echo 'Algo falló en el pipeline. Revisa la salida de errores.'
        }
    }
}
