<?php
class CompanyContextMiddleware
{
    public static function handle()
    {
        $pdo = db();
        $userId = $_SESSION['user_id'];
        if (empty($_SESSION['current_company_id'])) {
            $stmt = $pdo->prepare('SELECT companies.id FROM companies LEFT JOIN company_users ON company_users.company_id = companies.id AND company_users.user_id = ? WHERE companies.owner_user_id = ? OR company_users.user_id = ? ORDER BY companies.created_at ASC LIMIT 1');
            $stmt->execute([$userId, $userId, $userId]);
            $company = $stmt->fetch();
            if ($company) {
                $_SESSION['current_company_id'] = $company['id'];
            }
        }
    }
}
