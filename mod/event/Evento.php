<?php

class Evento
{

    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function listarDestaques($limite = 6)
    {

        $sql = $this->db->prepare("
            SELECT *
            FROM eventos
            WHERE publicado=1
            ORDER BY destaque DESC,
                     data_inicio ASC
            LIMIT :limite
        ");

        $sql->bindValue(':limite', $limite, PDO::PARAM_INT);

        $sql->execute();

        return $sql->fetchAll();

    }

}