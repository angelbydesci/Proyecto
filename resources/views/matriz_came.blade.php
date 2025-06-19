<div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <h1 class="text-2xl font-bold text-center mb-4">11. MATRIZ CAME</h1>

                        <p class="mb-4">A continuación y para finalizar de elaborar un Plan Estratégico, además de tener identificada la estrategia es necesario determinar acciones que permitan corregir las debilidades, afrontar las amenazas, mantener las fortalezas y explotar las oportunidades.</p>

                        <p class="mb-8 bg-gray-100 p-4 text-center">Reflexione y anote acciones a llevar a cabo teniendo en cuenta que estas acciones deben favorecer la ejecución exitosa de la estrategia general identificada.</p>

                        <form method="POST" action="{{ route('matriz_came.store', ['proyecto' => $proyecto->id]) }}">
                            @csrf
                            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                            <table class="w-full border-collapse border-2 border-black">
                                <tbody>
                                    <!-- Corregir las debilidades -->
                                    <tr>
                                        <td class="w-1/12 text-center font-bold text-2xl bg-teal-500 text-white border-2 border-black align-middle" rowspan="5">C</td>
                                        <td class="w-11/12 p-0" colspan="2">
                                            <div class="text-center font-bold bg-teal-500 text-white border-2 border-black p-2">Corregir las debilidades</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">1</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CDebilidades1" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CDebilidades1 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">2</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CDebilidades2" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CDebilidades2 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">3</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CDebilidades3" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CDebilidades3 ?? '' }}"></td>
                                    </tr>
                                     <tr>
                                        <td class="w-1/12 border-2 border-black text-center">4</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CDebilidades4" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CDebilidades4 ?? '' }}"></td>
                                    </tr>

                                    <!-- Afrontar las amenazas -->
                                    <tr>
                                        <td class="w-1/12 text-center font-bold text-2xl bg-teal-500 text-white border-2 border-black align-middle" rowspan="5">A</td>
                                        <td class="w-11/12 p-0" colspan="2">
                                            <div class="text-center font-bold bg-teal-500 text-white border-2 border-black p-2">Afrontar las amenazas</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">5</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CAmenazas1" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CAmenazas1 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">6</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CAmenazas2" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CAmenazas2 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">7</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CAmenazas3" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CAmenazas3 ?? '' }}"></td>
                                    </tr>
                                     <tr>
                                        <td class="w-1/12 border-2 border-black text-center">8</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CAmenazas4" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CAmenazas4 ?? '' }}"></td>
                                    </tr>

                                    <!-- Mantener las fortalezas -->
                                    <tr>
                                        <td class="w-1/12 text-center font-bold text-2xl bg-teal-500 text-white border-2 border-black align-middle" rowspan="5">M</td>
                                        <td class="w-11/12 p-0" colspan="2">
                                            <div class="text-center font-bold bg-teal-500 text-white border-2 border-black p-2">Mantener las fortalezas</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">9</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CFortalezas1" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CFortalezas1 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">10</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CFortalezas2" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CFortalezas2 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">11</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CFortalezas3" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CFortalezas3 ?? '' }}"></td>
                                    </tr>
                                     <tr>
                                        <td class="w-1/12 border-2 border-black text-center">12</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="CFortalezas4" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->CFortalezas4 ?? '' }}"></td>
                                    </tr>

                                    <!-- Explotar las oportunidades -->
                                    <tr>
                                        <td class="w-1/12 text-center font-bold text-2xl bg-teal-500 text-white border-2 border-black align-middle" rowspan="5">E</td>
                                        <td class="w-11/12 p-0" colspan="2">
                                            <div class="text-center font-bold bg-teal-500 text-white border-2 border-black p-2">Explotar las oportunidades</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">13</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="COportunidades1" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->COportunidades1 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">14</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="COportunidades2" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->COportunidades2 ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-1/12 border-2 border-black text-center">15</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="COportunidades3" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->COportunidades3 ?? '' }}"></td>
                                    </tr>
                                     <tr>
                                        <td class="w-1/12 border-2 border-black text-center">16</td>
                                        <td class="w-10/12 p-0 border-2 border-black"><input type="text" name="COportunidades4" class="w-full h-full border-none focus:ring-0" value="{{ $correcion->COportunidades4 ?? '' }}"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="flex items-center justify-end mt-8">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Guardar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>