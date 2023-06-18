<script setup lang="ts">
import { ref } from "vue";

const item = ref(null as any | null);
</script>

<template>
  <div>
    <dialog :open="item ? true : false">
      <div><strong>Add/Edit Transaction</strong></div>
      <div><hr /></div>

      <div><hr /></div>

      <div class="d-flex">
        <button
          class="btn btn-sm btn-danger px-1 py-0"
          @click="
            () => {
              item = null;
            }
          "
        >
          Cancel
        </button>
        <button class="btn btn-sm btn-success px-1 py-0">Save</button>
      </div>
    </dialog>
    <div class="d-flex">
      <div>Transactions</div>
      <button
        class="btn btn-sm btn-primary px-1 py-0"
        @click="
          () => {
            item = { transactionItems: [] };
          }
        "
      >
        Add
      </button>
    </div>
    <div
      class="border border-dark shadow shadow-md overflow-auto"
      style="height: 75vh; resize: vertical"
    >
      <table class="table table-sm" style="border-collapse: separate">
        <tr>
          <th
            class="bg-dark text-light p-0 m-0"
            v-for="h in [
              '#',
              'Items',
              'Types',
              'Net Value',
              'Created',
              'Updated',
            ]"
          >
            {{ h }}
          </th>
        </tr>
      </table>
    </div>
  </div>
</template>
