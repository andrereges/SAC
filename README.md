sac
===

Comandos a serem executados em novo ambiente:

1 Criar Base de Dados:
	php bin/console doctrine:database:create

2 Criar criar as Entidades:
	php bin/console doctrine:generate:entities AppBundle

3 Criar executar atualizar o schema do banco:
	php bin/console doctrine:schema:update --force

4 Carregar as fixtures - massa de dados:
	php bin/console doctrine:fixtures:load


