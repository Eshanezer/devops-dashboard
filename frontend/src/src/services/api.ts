import axios from 'axios';
import { s } from 'vite/dist/node/chunks/moduleRunnerTransport';

const api = axios.create({
  baseURL: '/api',
});

export function fetchDashboard(service :string, env : string) {
  return api.get('/dashboard', {
    params: { service },
  });
}
