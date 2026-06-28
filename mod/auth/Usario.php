<?php

// require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Busca usuário pelo ID
     */
    public function buscarPorId(int $id): ?array
    {
        $sql = $this->db->prepare("
            SELECT *
            FROM usuarios
            WHERE id = :id
            LIMIT 1
        ");

        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetch() ?: null;
    }

    /**
     * Busca usuário pelo e-mail
     */
    public function buscarPorEmail(string $email): ?array
    {
        $sql = $this->db->prepare("
            SELECT *
            FROM usuarios
            WHERE email = :email
            LIMIT 1
        ");

        $sql->bindValue(':email', trim($email));
        $sql->execute();

        return $sql->fetch() ?: null;
    }

    /**
     * Lista todos os usuários
     */
    public function listar(): array
    {
        $sql = $this->db->query("
            SELECT
                id,
                nome,
                email,
                tipo,
                ativo,
                ultimo_login,
                created_at
            FROM usuarios
            ORDER BY nome
        ");

        return $sql->fetchAll();
    }

    /**
     * Cadastra um usuário
     */
    public function cadastrar(array $dados): int
    {
        $sql = $this->db->prepare("
            INSERT INTO usuarios
            (
                nome,
                email,
                senha,
                tipo,
                ativo
            )
            VALUES
            (
                :nome,
                :email,
                :senha,
                :tipo,
                :ativo
            )
        ");

        $sql->bindValue(':nome', $dados['nome']);
        $sql->bindValue(':email', strtolower(trim($dados['email'])));
        $sql->bindValue(':senha', password_hash($dados['senha'], PASSWORD_DEFAULT));
        $sql->bindValue(':tipo', $dados['tipo'] ?? '3');
        $sql->bindValue(':ativo', $dados['ativo'] ?? 1);

        $sql->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Atualiza dados do usuário
     */
    public function atualizar(int $id, array $dados): bool
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET
                nome = :nome,
                email = :email,
                tipo = :tipo,
                ativo = :ativo
            WHERE id = :id
        ");

        return $sql->execute([
            ':nome' => $dados['nome'],
            ':email' => strtolower(trim($dados['email'])),
            ':tipo' => $dados['tipo'],
            ':ativo' => $dados['ativo'],
            ':id' => $id
        ]);
    }

    /**
     * Altera senha
     */
    public function alterarSenha(int $id, string $senha): bool
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET senha = :senha
            WHERE id = :id
        ");

        return $sql->execute([
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
            ':id' => $id
        ]);
    }

    /**
     * Ativar usuário
     */
    public function ativar(int $id): bool
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET ativo = 1
            WHERE id = :id
        ");

        return $sql->execute([':id'=>$id]);
    }

    /**
     * Desativar usuário
     */
    public function desativar(int $id): bool
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET ativo = 0
            WHERE id = :id
        ");

        return $sql->execute([':id'=>$id]);
    }

    /**
     * Excluir usuário
     */
    public function excluir(int $id): bool
    {
        $sql = $this->db->prepare("
            DELETE FROM usuarios
            WHERE id = :id
        ");

        return $sql->execute([':id'=>$id]);
    }

    /**
     * Verifica se e-mail já existe
     */
    public function emailExiste(string $email, ?int $ignorar = null): bool
    {
        if ($ignorar) {

            $sql = $this->db->prepare("
                SELECT id
                FROM usuarios
                WHERE email = :email
                AND id <> :id
            ");

            $sql->execute([
                ':email'=>$email,
                ':id'=>$ignorar
            ]);

        } else {

            $sql = $this->db->prepare("
                SELECT id
                FROM usuarios
                WHERE email = :email
            ");

            $sql->execute([
                ':email'=>$email
            ]);

        }

        return $sql->rowCount() > 0;
    }

    /**
     * Atualiza último login
     */
    public function atualizarUltimoLogin(int $id): void
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET ultimo_login = NOW()
            WHERE id = :id
        ");

        $sql->execute([
            ':id'=>$id
        ]);
    }
}