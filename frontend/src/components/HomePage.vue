<script setup lang="ts">
import { ctx } from "../main";
</script>
<template>
  <div>
    <div>
      Hello. You are logged in as {{ ctx.tenant?.name }} ({{
        ctx.tenant?.email
      }})
    </div>
  </div>
</template>
