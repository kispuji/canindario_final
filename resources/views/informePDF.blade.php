<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            div.tabla{
                text-align: center;
                margin: 1.4rem 0;
                border: 1px grey solid;
                border-radius: 0.5rem;
                overflow: hidden;
            }
            div.tabla table{
                margin: 0 auto;
                text-align: left;
                width: 100%;
                border-collapse: collapse;
            }
            div.tabla thead{
                width: 100%;
            }
 
            div.tabla tr {
                text-align: center;
                width: 100%;
            }
            div.tabla th{
                padding: 0.5rem 0.2rem;

            }
            div.tabla tr td{
                padding: 0.4rem 0.2rem;
                color: rgb(78, 78, 78);
            }
            .cabecera{
                background-color: dimgray;
                color: white;
            }
            .encabezado th{
                background-color: rgb(206, 206, 206);
            }
            h1{
                text-align: center;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <h1>Infome de resultados</h1>
        <div class="tabla">
            {{-- Tabla diarios --}}
            <table>
                <thead>
                    <tr class="cabecera">
                        <th colspan="3">Diarios</th>
                    </tr>
                    <tr class="encabezado">
                        <th>Tipo</th>
                        <th>Tiempo (Minutos)</th>                           
                        <th>Kilometros</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipos as $tipo)
                    <tr class="celdas">
                        <td>{{$tipo->name}}</td>
                        @foreach ($totalesDiarios["$tipo->name"] as $item)
                            <td>{{$item != null ? $item : 0}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div></div>
        </div>

        <div class="tabla">
            {{-- Tabla obediencia --}}
            <table>
                <thead>
                    <tr class="cabecera">
                        <th colspan="4">Obediencia</th>
                    </tr>
                    <tr class="encabezado">
                        <th>Orden</th>
                        <th>Porcentaje de aciertos</th>                           
                        <th>Porcentaje de fallos</th>
                        <th>Tiempo (Minutos)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordenes as $orden)
                    <tr class="celdas">
                        <td>{{$orden->name}}</td>
                        @foreach ($totalesObediencia["$orden->name"] as $item)
                            <td>{{$item != null ? $item : 0}}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div></div>
        </div>

        <div class="tabla">
            {{-- Tabla busqueda --}}
            <table>
                <thead>
                    <tr class="cabecera">
                        <th colspan="4">Búsqueda</th>
                    </tr>
                    <tr class="encabezado">
                        <th>Sustancias</th>
                        <th>Pocentaje aciertos</th>                           
                        <th>Porcentaje fallos</th>
                        <th>Tiempo (Segundos)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($sustancias as $sustancia)
                    <tr class="celdas">
                        <td>{{$sustancia->name}}</td>
                        @foreach ($totalesBusqueda["$sustancia->name"] as $item)
                            <td>{{$item != null ? $item : 0}}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div></div>
        </div>
    </body>
</html>