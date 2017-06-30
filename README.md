sac
===

Comandos a serem executados em novo ambiente:

______ Criar Base de Dados ____________
	php bin/console doctrine:database:create

______ Criar criar as Entidades ____________
	php bin/console doctrine:generate:entities AppBundle

______ Criar executar atualizar o schema do banco:
	php bin/console doctrine:schema:update --force

______ Carregar as fixtures - massa de dados ____________
	php bin/console doctrine:fixtures:load


