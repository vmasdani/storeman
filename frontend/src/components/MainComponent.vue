<script setup lang="ts">
import jwtDecode from "jwt-decode";
import { ctx } from "../main";
import LoginPage from "./LoginPage.vue";
import NavComponent from "./NavComponent.vue";
import { fetchTenant } from "../fetchers";

const init = async () => {
  fetchTenantData();
};

const fetchTenantData = async () => {
  if (!ctx.value.apiKey) {
    return;
  }

  const id = (jwtDecode(ctx.value.apiKey ?? "") as any)?.jti;

  if (!id) {
    return;
  }

  const t = await fetchTenant({ id: id });
  ctx.value.tenant = t;
};

init();
</script>

<template>
  <div v-if="ctx.apiKey">
    <NavComponent />
    <div class="m-3"><RouterView /></div>
  </div>
  <div v-else>
    <LoginPage />
  </div>
</template>
