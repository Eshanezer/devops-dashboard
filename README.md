# DevOps Dashboard

A lightweight internal DevOps dashboard that centralizes service health, CI/CD status,
environment metadata, and release information across multiple services.

This project is designed to evolve incrementally, following real-world DevOps and
platform engineering practices.

---

## 🎯 Project Goals

- Provide a single view of system health and delivery status
- Simulate real internal DevOps tooling used in production environments
- Demonstrate CI/CD, containerization, and environment awareness
- Serve as a long-term evolving portfolio project

---

## 🧩 Managed Services

The dashboard tracks multiple services:

| Service Name   | Description                         |
|---------------|-------------------------------------|
| frontend-app  | Vue 3 frontend application          |
| backend-api   | Laravel backend API                 |
| auth-service  | Mock authentication service         |

---

## 🌍 Environments

Each service can run in multiple environments:

- **development**
- **staging**
- **production**

Environment context affects:
- Service health
- CI/CD status
- Deployment metadata

---

## 🏗 Architecture (High-Level)

+--------------------+
| Vue 3 Dashboard |
| (frontend-app) |
+---------+----------+
|
| REST API
|
+---------v----------+
| Laravel API |
| (backend-api) |
+---------+----------+
|
| Simulated data
|
+---------v----------+
| auth-service |
| (mocked) |
+--------------------+


---

## 🔁 CI/CD Overview

- GitHub Actions handles:
  - Backend linting & testing
  - Frontend build validation
- Pipelines run on every push to main

---

## 🐳 Local Development (Planned)

The project will use Docker Compose to run:

- frontend-app
- backend-api

With a single command:

```bash
docker compose up

🚀 Deployment (Planned)

Frontend: Vercel

Backend: Railway or Render

🛣 Roadmap

V1.5: Multi-service, multi-environment dashboard

V2: GitHub Actions integration

V3: Auth, persistence, metrics, and alerts