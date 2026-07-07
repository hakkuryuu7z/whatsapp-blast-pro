FROM node:18-alpine

WORKDIR /app

# Copy package.json dan install dependensi
COPY package*.json ./
RUN npm install

# Copy sisa kodingan node.js
COPY . .

# Expose port 3000
EXPOSE 3000

CMD ["node", "index.js"]