<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Municipalidad;

class MunicipalidadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function flujo_completo_crud_municipalidad()
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

          // Crear
        $response = $this->postJson('/api/municipalidades', $data);
        $response->assertStatus(201);

    // Leer
        $response = $this->getJson('/api/municipalidades');
        $response->assertStatus(200)->assertJsonFragment(['nombre' => 'Municipalidad A']);

    // Actualizar
        $id = $response->json()[0]['id'];
        $response = $this->putJson("/api/municipalidades/$id", ['nombre' => 'Municipalidad Modificada']);
        $response->assertStatus(200);

    // Eliminar
        $response = $this->deleteJson("/api/municipalidades/$id");
        $response->assertStatus(204);
    }
}
