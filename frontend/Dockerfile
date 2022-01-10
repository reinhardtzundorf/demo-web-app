# FRONTEND DOCKERFILE
# 2021/01/10

FROM node:lts-alpine

RUN npm install -g http-server
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Expose port 10000
EXPOSE 10000

# Serve dist dir.
CMD [ "http-server", "dist" ]
