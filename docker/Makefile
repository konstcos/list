build-prod:
	docker buildx build --push --platform "linux/amd64","linux/arm64" --tag "$(IMAGE):$(TAG)" ./$(FOLDER)/

build-dev:
	docker buildx build --push --platform "linux/amd64","linux/arm64" --build-arg APP_ENV="dev" --tag "$(IMAGE)-dev:$(TAG)" ./$(FOLDER)/

create-builder:
	docker buildx create --use --name new-builder
