# DevOps Dashboard

A lightweight internal DevOps dashboard that centralizes service health, CI/CD status,
environment metadata, and release information across multiple services.

This project is designed to evolve incrementally, following real-world DevOps and
platform engineering practices.

---

## 🎯 Project Goals

- Provide a single view of system health and delivery status
- Simulate internal DevOps tooling used in production environments
- Demonstrate CI/CD, containerization, and environment awareness
- Serve as a long-term evolving portfolio project

## 🧩 Managed Services

The dashboard tracks multiple services:

| Service Name  | Description                    |
| ------------- | ------------------------------ |
| frontend-app  | Vue 3 frontend application     |
| backend-api   | Laravel backend API            |
| auth-service  | Mock authentication service    |

## 🌍 Environments

Each service can run in multiple environments:

- **development**
- **staging**
- **production**

Environment context affects service health, CI/CD status, and deployment
metadata.

## 🏗 Architecture (High-Level)

Frontend <--> Backend API <--> Mocked auth/service data

Simple ASCII view:

```
   +----------------+        +----------------+
   | frontend-app   | <----> | backend-api    |
   | (Vue 3)        |        | (Laravel)      |
   +----------------+        +----------------+
                                 |
                                 v
                          +----------------+
                          | auth-service   |
                          | (mocked)       |
                          +----------------+
```

Browser
 ├── http://localhost:5173  → Vue Frontend
 └── http://localhost:8080  → Laravel Backend

Vue Container
 └── calls http://backend:8000/api/dashboard

Laravel Container
 └── connects to mysql:3306

MySQL Container
 └── stores persistent data

## 🔁 CI/CD Overview

- GitHub Actions runs linting, tests, and build validation for backend and
  frontend.
- Pipelines run on pushes to the main branch.

## 🐳 Docker-First Development

This project is fully containerized. All services (frontend and backend) are
developed and run inside Docker containers.

### Start the entire system

```bash
docker compose -f infra/docker-compose.yml up --build
```

## 🚀 Deployment (Planned)

- Frontend: Vercel
- Backend: Railway or Render

## 🛣 Roadmap

- V1.5: Multi-service, multi-environment dashboard
- V2: GitHub Actions integration
- V3: Auth, persistence, metrics, and alerts

## Contributing

Contributions are welcome. Please open issues or PRs for enhancements or bugs.

## License

Specify a license for the project here (e.g., MIT). If you don't have one yet,
add a `LICENSE` file and update this section.
