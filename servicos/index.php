<?php
session_start();
if(isset($_SESSION['u_id'])){
 require "../header/header.php";
    echo '<div id="warnings"></div>
        <!-- Modal -->
        <div class="modal fade" id="loadservico" data-backdrop="static" data-keyboard="false" tabindex="1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <?php require "dataServico.php"?>
                </div>
            </div>
        </div>
    <section class="shadow-sm mx-auto w-75 shadow clearfix mt-5 rounded bg-white p-5 resize position-relative">
        <h1 class="mb-4 text-center">Serviços</h1>
        <form>
            <div class="form-row my-3">
                <div class="text-center w-100">
                    <input type="search" class="form-control d-inline-block align-middle w-75" placeholder="Pesquise pelo seu serviço" name="servico_nome">
                    <button type="submit" name="search" id="servico" class="btn">
                        <svg class="bi bi-search mb-1 mr-2" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"></path>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>            
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <svg class="bi bi-archive" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2 5v7.5c0 .864.642 1.5 1.357 1.5h9.286c.715 0 1.357-.636 1.357-1.5V5h1v7.5c0 1.345-1.021 2.5-2.357 2.5H3.357C2.021 15 1 13.845 1 12.5V5h1z"/>
                                            <path fill-rule="evenodd" d="M5.5 7.5A.5.5 0 0 1 6 7h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5zM15 2H1v2h14V2zM1 1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H1z"/>
                                        </svg>
                                    </div>
                                    <h5 class="card-title text-center">Dados</h5>
                                    <button type="button" class="btn btn-primary" id="dados">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <svg class="bi bi-laptop" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M13.5 3h-11a.5.5 0 0 0-.5.5V11h12V3.5a.5.5 0 0 0-.5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11z"/>
                                            <path d="M0 12h16v.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5V12z"/>
                                        </svg>
                                    </div>
                                    <h5 class="card-title">Equipamentos</h5>
                                    <button class="btn btn-primary" id="equipamentos">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <svg class="bi bi-award" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l-1.51-.229L8 1.126l-1.355.702-1.51.229-.684 1.365-1.086 1.072L3.614 6l-.25 1.506 1.087 1.072.684 1.365 1.51.229L8 10.874l1.356-.702 1.509-.229.684-1.365 1.086-1.072L12.387 6l.248-1.506-1.086-1.072-.684-1.365z"/>
                                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                                        </svg>
                                    </div>
                                    <h5 class="card-title">Formações</h5>
                                    <button class="btn btn-primary" id="formacao">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="card shadow-sm text-center">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <svg class="bi bi-cart4" width="4em" height="4em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                        </svg>
                                    </div>
                                    <h5 class="card-title">Produtos</h5>
                                    <button class="btn btn-primary" id="produtos">Pesquisar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
        <div   id="resultado-pesquisa" class="show w-100 pb-5 pt-0 bg-white" style="display: none;height: calc(100% - 13rem);">
           '; include "Pesquisa.php";
        echo '</div>
    </section>
</body>
</html>';
}
else{
    header("Location: ../login/");
}
?>




