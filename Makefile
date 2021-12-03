run-local:
	./script/local/run-local.sh
run-db:
	./script/local/run-mariadb.sh
down-db:
	./script/local/down-mariadb.sh
destroy-local:
	./script/local/destroy.sh

run-cloud:
	./script/cloud/run-cloud.sh
	./script/cloud/log.sh
down-cloud:
	./script/cloud/down-cloud.sh
