<script setup lang="ts">
import { ref } from "vue";
import { ctx } from "../main";
import { fetchTenant } from "../fetchers";
import jwtDecode from "jwt-decode";

const d = ref({ email: "", password: "" });

const handleLogin = async () => {
  try {
    const resp = await fetch(
      `${window.location.origin}/api/jwt-by-email?email=${d.value.email}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    const token = await resp.text();

    ctx.value.apiKey = token;
    const tenantData = await fetchTenant({
      id: (jwtDecode(token) as any)?.jti,
    });
    ctx.value.tenant = tenantData;
    localStorage.setItem("apiKey", token);
  } catch (e) {
    console.error(e);
    alert(e);
  }
};
</script>

<template>
  <div
    class="vw-100 vh-100 d-flex flex-column justify-content-center align-items-center"
  >
    <form
      @submit="
        async (e) => {
          e.preventDefault();

          handleLogin();
        }
      "
    >
      <div>
        <div
          class="border border-dark d-flex flex-column justify-content-center align-items-center rounded rounded-lg bg-light p-4"
        >
          <div>
            <h3>Storeman Login</h3>
          </div>
          <div>
            <input
              class="form-control form-control-sm"
              placeholder="Email..."
              @input="e => {
              d.email = (e.target as HTMLInputElement).value
            }"
            />
          </div>
          <div>
            <button type="submit" class="btn btn-sm btn-primary px-2 py-0">
              Login
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>
