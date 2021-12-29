

## Como rodar o projeto

	Rode os seguintes comandos:

- **composer install**
- **php artisan key:generate**
- **php artisan config:cache**
- **php artisan migrate**

### Outras instruções

Agora é só criar um usuário e fazer login para usar o sistema.

### Comando SQL

select * from products
	where exists (select * from tags inner join product_tag on tags.id = product_tag.tag_id 
	where products.id = product_tag.product_id and tag_id in (1, 2, 3, 4, 5) )