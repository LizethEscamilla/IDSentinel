@extends('layouts.app')

@section('content')

{{-- Estilos para los logos en las esquinas superiores --}}
<style>
    .logo-header {
        position: relative;
        height: 100px;
        margin-bottom: 0;
    }

    .logo-left {
        position: absolute;
        top: 5px;  /* Subí un poco */
        left: 10px;
        height: 100px;
        padding: 5px;
    }

    .logo-right {
        position: absolute;
        top: 5px;  /* Subí un poco */
        right: 10px;
        height: 100px;
        padding: 5px;
    }

    .content-section {
        position: relative;
        top: -60px; /* Antes era 20px, ahora sube el contenido */
    }
    
    /* Nuevos estilos para centrar */
    .header-center {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .button-center {
        text-align: center;
        margin-bottom: 30px;
    }
</style>

{{-- Contenedor de logos --}}
<div class="logo-header">
    <img src="{{ asset('images/logo1.png') }}" alt="Logo Izquierdo" class="logo-left">
    <img src="{{ asset('images/logo2.png') }}" alt="Logo Derecho" class="logo-right">
</div>

<div class="container content-section">
    <div class="container mt-4">
        <div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
            <!-- Título centrado -->
            <div class="header-center">
                <h1 style="font-size: 24px; font-weight: bold;">Estadísticas de Uso</h1>
            </div>
            
            <!-- Botón centrado -->
            <div class="button-center">
                <a href="{{ route('statistics.export') }}" 
                   style="display: inline-block; background-color: #9D2449; color: white; font-weight: bold; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    📊 Generar Excel
                </a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
                <div style="background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Alumnos por Materia</h2>
                    <canvas id="alumnosMateriaChart" width="300" height="300"></canvas>
                </div>

                <div style="background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Alumnos por Grupo de Carrera</h2>
                    <canvas id="alumnosGrupoChart" width="300" height="300"></canvas>
                </div>

                <div style="background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Alumnos por Tipo de Software</h2>
                    <canvas id="alumnosSoftwareChart" width="300" height="300"></canvas>
                </div>

                <div style="background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Accesos por Día</h2>
                    <canvas id="accesosDiaChart" width="300" height="300"></canvas>
                </div>

                <div style="background: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; text-align: center;">
                    <h2 style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">Horas Usadas por Profesor</h2>
                    <canvas id="horasProfesorChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function getRandomColors(num) {
        const palette = [
            '#9D2449', '#F9A825', '#2E7D32', '#1565C0', '#FF5722',
            '#4A148C', '#00695C', '#E65100', '#1B5E20', '#B71C1C'
        ];
        let colors = [];
        for (let i = 0; i < num; i++) {
            colors.push(palette[i % palette.length]);
        }
        return colors;
    }

    // Alumnos por Materia
    new Chart(document.getElementById('alumnosMateriaChart'), {
        type: 'bar',
        data: {
            labels: @json($resumenData['alumnos_por_materia_labels']),
            datasets: [{
                label: 'Número de alumnos',
                data: @json($resumenData['alumnos_por_materia_data']),
                backgroundColor: getRandomColors(@json(count($resumenData['alumnos_por_materia_labels']))),
            }]
        },
        options: {
            responsive: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Alumnos por Grupo
    new Chart(document.getElementById('alumnosGrupoChart'), {
        type: 'pie',
        data: {
            labels: @json($resumenData['alumnos_por_grupo_labels']),
            datasets: [{
                data: @json($resumenData['alumnos_por_grupo_data']),
                backgroundColor: getRandomColors(@json(count($resumenData['alumnos_por_grupo_labels']))),
            }]
        },
        options: {
            responsive: false
        }
    });

    // Alumnos por Software
    new Chart(document.getElementById('alumnosSoftwareChart'), {
        type: 'doughnut',
        data: {
            labels: @json($resumenData['alumnos_por_software_labels']),
            datasets: [{
                data: @json($resumenData['alumnos_por_software_data']),
                backgroundColor: getRandomColors(@json(count($resumenData['alumnos_por_software_labels']))),
            }]
        },
        options: {
            responsive: false
        }
    });

    // Accesos por Día
    new Chart(document.getElementById('accesosDiaChart'), {
        type: 'line',
        data: {
            labels: @json($resumenData['accesos_por_dia_labels']),
            datasets: [{
                label: 'Accesos',
                data: @json($resumenData['accesos_por_dia_data']),
                fill: false,
                borderColor: '#9D2449',
                tension: 0.3
            }]
        },
        options: {
            responsive: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Horas por Profesor
    new Chart(document.getElementById('horasProfesorChart'), {
        type: 'radar',
        data: {
            labels: @json($resumenData['horas_por_profesor_labels']),
            datasets: [{
                label: 'Horas',
                data: @json($resumenData['horas_por_profesor_data']),
                backgroundColor: 'rgba(157, 36, 73, 0.2)',
                borderColor: '#9D2449',
                pointBackgroundColor: '#9D2449'
            }]
        },
        options: {
            responsive: false,
            scales: {
                r: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection

