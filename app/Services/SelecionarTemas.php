<?php

namespace App\Services;

class SelecionarTemas
{
    public static function temas($pagina) {
        if ($pagina == "Home" || $pagina == "Regras" || $pagina == "Descrições" || $pagina == "Totais" || $pagina == "Batalhas" || $pagina == "Batalha" || $pagina == "Créditos") {
            $temas = ["secondary", "primary", "escuro"];
            
            if (session("tema") == "claro" || !session()->has("tema")) {
                $temas = ["dark", "danger", "claro"];
            }
        } elseif ($pagina == "Cadastro" || $pagina == "Atualização" || $pagina == "Atualização Senha") {
            $temas = ["secondary", "primary", "light", "black", "escuro"];
            
            if (session("tema") == "claro" || !session()->has("tema")) {
                $temas = ["dark", "danger", "dark", "white", "claro"];
            }
        } elseif ($pagina == "Listagem" || $pagina == "Registro") {
            $temas = ["secondary", "primary", "light", "escuro"];
            
            if (session("tema") == "claro" || !session()->has("tema")) {
                $temas = ["dark", "danger", "dark", "claro"];
            }
        } elseif ($pagina == "Preparação") {
            $temas = ["secondary", "primary", "cor_niveis", "light", "escuro"];
            
            if (session("tema") == "claro" || !session()->has("tema")) {
                $temas = ["dark", "danger", "text-danger", "dark", "claro"];
            }
        }

        return $temas;
    }
}