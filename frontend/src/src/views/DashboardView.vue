<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import { fetchDashboard } from "../services/api";

type DashboardData = {
  service: string;
  environment: string;
  status: string;
  version: string;
  uptime: number;
  ci: {
    pipeline: string;
    commit: string;
  };
};

// selectable options
const services = ["backend-api", "frontend-app", "auth-service"];
const environments = ["development", "staging", "production"];

// selected values
const selectedService = ref("backend-api");
const selectedEnv = ref("development");

// state
const loading = ref(true);
const error = ref<string | null>(null);
const dashboard = ref<DashboardData | null>(null);

async function loadDashboard() {
  loading.value = true;
  error.value = null;

  try {
    const res = await fetchDashboard(selectedService.value, selectedEnv.value);
    dashboard.value = res.data;
  } catch (err) {
    console.error(err);
    error.value = "Failed to load dashboard data";
  } finally {
    loading.value = false;
  }
}

// load on first render
onMounted(loadDashboard);

// reload when service or env changes
watch([selectedService, selectedEnv], loadDashboard);

function statusClass(value: string) {
  switch (value) {
    case "healthy":
    case "passed":
      return "status-green";
    case "degraded":
    case "running":
      return "status-yellow";
    case "down":
    case "failed":
      return "status-red";
    default:
      return "";
  }
}
</script>

<template>
  <div class="dashboard">
    <h1>DevOps Dashboard</h1>

    <!-- Controls -->
    <div class="controls">
      <label>
        Service:
        <select v-model="selectedService">
          <option v-for="service in services" :key="service" :value="service">
            {{ service }}
          </option>
        </select>
      </label>

      <label>
        Environment:
        <select v-model="selectedEnv">
          <option v-for="env in environments" :key="env" :value="env">
            {{ env }}
          </option>
        </select>
      </label>
    </div>

    <!-- Loading -->
    <p v-if="loading">Loading dashboard data...</p>

    <!-- Error -->
    <p v-else-if="error" class="error">{{ error }}</p>

    <!-- Dashboard -->
    <div v-else-if="dashboard" class="cards">
      <div class="card">Service: {{ dashboard.service }}</div>
      <div class="card">Environment: {{ dashboard.environment }}</div>
      <div class="card" :class="statusClass(dashboard.status)">
        Status: {{ dashboard.status }}
      </div>
      <div class="card">Version: {{ dashboard.version }}</div>
      <div class="card" :class="statusClass(dashboard.ci.pipeline)">
        CI: {{ dashboard.ci.pipeline }}
      </div>
      <div class="card">Uptime: {{ dashboard.uptime }}s</div>
    </div>
  </div>
</template>

<style scoped>
.controls {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

select {
  margin-left: 0.5rem;
  padding: 0.3rem;
}

.status-green {
  border-left: 6px solid #2ecc71;
  background-color: #eafaf1;
}

.status-yellow {
  border-left: 6px solid #f1c40f;
  background-color: #fff9e6;
}

.status-red {
  border-left: 6px solid #e74c3c;
  background-color: #fdecea;
}

.card {
  transition: background-color 0.2s ease, border-color 0.2s ease;
}

</style>
