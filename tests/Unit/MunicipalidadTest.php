<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Municipalidad;

class MunicipalidadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_una_municipalidad_con_todos_los_campos()
    {
        $data = [
            'nombre' => 'Municipalidad Capachica',
            'descripcion' => 'Descripción breve',
            'red_facebook' => 'https://facebook.com/municapachica',
            'red_instagram' => 'https://instagram.com/municapachica',
            'red_youtube' => 'https://youtube.com/municapachica',
            'coordenadas_x' => '-15.521',
            'coordenadas_y' => '-70.123',
            'frase' => 'Capachica unida por el progreso',
            'comunidades' => 'Comunidad A, Comunidad B',
            'historiafamilias' => 'Historia de las familias',
            'historiacapachica' => 'Historia del distrito',
            'comite' => 'Comité de Desarrollo',
            'mision' => 'Nuestra misión es...',
            'vision' => 'Nuestra visión es...',
            'valores' => 'Transparencia, Equidad, Servicio',
            'ordenanzamunicipal' => 'Ordenanza N°001',
            'alianzas' => 'Alianza con ONG X',
            'correo' => 'info@capachica.gob.pe',
            'horariodeatencion' => 'Lun-Vie 8:00-17:00',
        ];

        $municipalidad = Municipalidad::create($data);

        $this->assertDatabaseHas('municipalidad', ['nombre' => 'Municipalidad Capachica']);
        $this->assertEquals($data['descripcion'], $municipalidad->descripcion);
    }
}
