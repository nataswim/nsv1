init-publish:
	docker context create nataswim-site --docker "host=ssh://root@168.231.107.219"
	docker context use nataswim-site
	
publish:
	docker context use nataswim-site
	docker-compose -f ./docker-stack.yml down
	docker-compose -f ./docker-stack.yml up -d
	
publish-data:
	docker exec $$(docker ps --filter "name=laravel-docker" --format "{{.ID}}") bash -c "php artisan migrate --force"
	docker exec $$(docker ps --filter "name=laravel-docker" --format "{{.ID}}") bash -c "php artisan db:seed --force"