# Utilisez l'image Node.js officielle avec l'installation d'Angular CLI
FROM node:latest as builder

WORKDIR /app

# Copiez les fichiers nécessaires pour installer les dépendances
COPY package.json package-lock.json ./
RUN npm install

# Copiez tout le projet dans le conteneur Docker
COPY . .

# Construisez l'application Angular pour la production
RUN npm run build

# Utilisez une image légère pour exécuter l'application Angular
FROM nginx:latest

# Copiez les fichiers construits de l'étape précédente dans le répertoire Nginx
COPY --from=builder /app/dist/front /usr/share/nginx/html

# Exposez le port 80 pour le serveur web Nginx
EXPOSE 80
