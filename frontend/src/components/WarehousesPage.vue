<script setup lang="ts">
import { ref } from "vue";
import { ctx } from "../main";
import { fetchWarehouses } from "../fetchers";

const warehouses = ref([] as any[]);
const warehouse = ref(null as any | null);

const handleSave = async () => {
  try {
    const resp = await fetch(`${window.location.origin}/api/warehouses`, {
      method: "post",
      headers: { Authorization: ctx.value.apiKey ?? "" },
      body: JSON.stringify(warehouse.value),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    window.location.reload();
  } catch (e) {}
};

const fetchWarehousesData = async () => {
  const d = await fetchWarehouses({ apiKey: ctx.value.apiKey ?? "" });

  if (d) {
    warehouses.value = d;
  }
};

fetchWarehousesData();
</script>

<template>
  <div>
    <dialog :open="warehouse ? true : false">
      <div><strong>Add/Edit Warehouse</strong></div>
      <div><hr /></div>
      <div>
        <input
          class="form-control form-control-sm"
          :value="warehouse?.name ?? ''"
          placeholder="Name..."
          @blur="e=>{
            warehouse.name=(e.target as HTMLInputElement).value
          }"
        />
      </div>
      <div><hr /></div>

      <div class="d-flex">
        <button
          class="btn btn-sm btn-danger px-1 py-0"
          @click="
            () => {
              warehouse = null;
            }
          "
        >
          Cancel
        </button>
        <button
          class="btn btn-sm btn-success px-1 py-0"
          @click="
            () => {
              handleSave();
            }
          "
        >
          Save
        </button>
      </div>
    </dialog>
    <div class="d-flex">
      <div>Warehouses</div>
      <button
        class="btn btn-sm btn-primary px-1 py-0"
        @click="
          () => {
            warehouse = {};
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
            v-for="h in ['#', 'Name', 'Created', 'Updated']"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(w, i_) in (warehouses as any[])">
          <td class="border border-dark p-0 m-0">{{ i_ + 1 }}</td>
          <td class="border border-dark p-0 m-0">
            <div
              class="text-primary"
              @click="
                () => {
                  warehouse = w;
                }
              "
              style="cursor: pointer"
            >
              {{ w?.name && w?.name !== "" ? w?.name : "No Name" }}
            </div>
          </td>
          <td class="border border-dark p-0 m-0">
            {{
              (() => {
                try {
                  return Intl.DateTimeFormat("en-US", {
                    dateStyle: "short",
                    timeStyle: "short",
                  }).format(new Date(w?.created_at ?? ""));
                } catch (e) {
                  return "";
                }
              })()
            }}
          </td>
          <td class="border border-dark p-0 m-0">
            {{
              (() => {
                try {
                  return Intl.DateTimeFormat("en-US", {
                    dateStyle: "short",
                    timeStyle: "short",
                  }).format(new Date(w?.updated_at ?? ""));
                } catch (e) {
                  return "";
                }
              })()
            }}
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>
