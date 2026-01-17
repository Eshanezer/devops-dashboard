# Use official Node.js 20 lightweight image
FROM node:20-alpine

# Set working directory inside the container
# All Vue source code will live here
WORKDIR /app

# Expose Vite default development server port
# This documents that the container listens on port 5173
EXPOSE 5173

HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD curl -f http://localhost/ || exit 1

# Default command executed when the container starts:
# 1. Install npm dependencies inside the container
# 2. Start the Vite dev server
# 3. --host binds to 0.0.0.0 so it is accessible outside Docker
CMD ["sh", "-c", "npm install && npm run dev -- --host"]
