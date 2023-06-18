<script setup lang="ts">
import { ref } from 'vue'

defineProps<{ msg: string }>()

const countx = ref(0)
</script>
<template>
    <div>About {{ countx }}</div>
</template>