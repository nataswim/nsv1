# Étape de build
FROM node:20 as build

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

# Étape de production avec Nginx
FROM nginx:alpine

# Copier la configuration Nginx personnalisée
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copier les fichiers construits depuis l'étape de build
COPY --from=build /app/build /usr/share/nginx/html

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]