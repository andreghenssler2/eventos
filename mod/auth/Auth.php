<?php

// require_once __DIR__ . '/../config/database.php';


class Auth
{
    private PDO $db;

    public function __construct()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $this->db = Database::connect();
    }

    /**
     * Realiza o login
     */
    public function login(string $email, string $senha): bool
    {
        $sql = $this->db->prepare("
            SELECT *
            FROM usuarios
            WHERE email = :email
            AND ativo = 1
            LIMIT 1
        ");

        $sql->bindValue(':email', trim($email));
        $sql->execute();

        if (!$sql->rowCount()) {
            return false;
        }

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($senha, $usuario['senha'])) {
            return false;
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email'],
            'tipo' => $usuario['tipo']
        ];

        $this->atualizarUltimoLogin($usuario['id']);

        return true;
    }

    /**
     * Atualiza último acesso
     */
    private function atualizarUltimoLogin(int $id): void
    {
        $sql = $this->db->prepare("
            UPDATE usuarios
            SET ultimo_login = NOW()
            WHERE id = :id
        ");

        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    /**
     * Logout
     */
    public static function logout(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
    }

    /**
     * Usuário logado?
     */
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Retorna usuário
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * ID do usuário
     */
    public static function id(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }

    /**
     * Nome
     */
    public static function nome(): ?string
    {
        return $_SESSION['user']['nome'] ?? null;
    }

    /**
     * Email
     */
    public static function email(): ?string
    {
        return $_SESSION['user']['email'] ?? null;
    }

    /**
     * Tipo
     */
    public static function tipo(): ?string
    {
        return $_SESSION['user']['tipo'] ?? null;
    }

    /**
     * É administrador?
     */
    public static function isAdmin(): bool
    {
        return self::tipo() === '1';
    }

    /**
     * É moderador?
     */
    public static function isModerador(): bool
    {
        return self::tipo() === '2';
    }

    /**
     * É participante?
     */
    public static function isParticipante(): bool
    {
        return self::tipo() === '3';
    }

    /**
     * Exige login
     */
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header("Location: /login.php");
            exit;
        }
    }

    /**
     * Exige administrador
     */
    public static function requireAdmin(): void
    {
        self::requireLogin();

        if (!self::isAdmin()) {
            http_response_code(403);
            exit('Acesso negado.');
        }
    }

    /**
     * Exige moderador ou administrador
     */
    public static function requireModerador(): void
    {
        self::requireLogin();

        if (!self::isAdmin() && !self::isModerador()) {
            http_response_code(403);
            exit('Acesso negado.');
        }
    }

    /**
     * Redireciona para o painel correto
     */
    public static function redirectDashboard(): void
    {
        if (!self::check()) {
            header("Location: /login.php");
            exit;
        }

        switch (self::tipo()) {

            case '1':
                header("Location: /admin/dashboard.php");
                break;

            case '2':
                header("Location: /admin/dashboard.php");
                break;

            case '3':
                header("Location: /participante/dashboard.php");
                break;

            default:
                header("Location: /");
        }

        exit;
    }
}