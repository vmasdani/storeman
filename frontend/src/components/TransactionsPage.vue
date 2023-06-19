<script setup lang="ts">
import { ref } from "vue";
import { makeDateString, transactionTypes } from "../helpers";
import { fetchItems, fetchTransactions, fetchWarehouses } from "../fetchers";
import { ctx } from "../main";
import VueSelect from "vue-select";
import { transactionTypeFromJSON, transactionTypeToJSON } from "../storeman";

const warehouses = ref([] as any[]);
const transaction = ref(null as any | null);
const transactions = ref([] as any[]);
const items = ref([] as any[]);
const loading = ref(false);
const from = ref(makeDateString(new Date()));
const to = ref(makeDateString(new Date()));

const handleSave = async () => {
  try {
    loading.value = true;
    const resp = await fetch(`${window.location.origin}/api/transactions`, {
      method: "post",
      headers: { Authorization: ctx.value.apiKey ?? "" },
      body: JSON.stringify(transaction.value),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    window.location.reload();
  } catch (e) {
  } finally {
    loading.value = false;
  }
};

const fetchItemsData = async () => {
  const d = await fetchItems({ apiKey: ctx.value.apiKey ?? "" });

  if (d) {
    items.value = d;
  }
};

const fetchTransactionsData = async () => {
  const d = await fetchTransactions({ apiKey: ctx.value.apiKey ?? "" });

  if (d) {
    transactions.value = d;
  }
};

const fetchWarehousesData = async () => {
  const d = await fetchWarehouses({ apiKey: ctx.value.apiKey ?? "" });

  if (d) {
    warehouses.value = d;
  }
};
fetchItemsData();
fetchWarehousesData();
fetchTransactionsData();
</script>

<template>
  <div>
    <dialog
      :open="transaction ? true : false"
      class="bg-light"
      style="z-index: 1"
    >
      <div style="width: 75vw">
        <div><strong>Add/Edit Transaction</strong></div>
        <div><hr /></div>
        <div>
          <button
            class="btn btn-sm btn-primary px-1 py-0"
            @click="
              () => {
                transaction?.transaction_items?.push({});
              }
            "
          >
            Add
          </button>
        </div>
        <div
          class="overflow-auto border border-dark p-0 m-0"
          style="height: 35vh; resize: vertical"
        >
          <table class="table table-sm" style="border-collapse: separate">
            <tr>
              <th
                class="bg-dark text-light"
                v-for="i in ['#', 'Item', 'Qty', 'Type', 'Warehouse']"
                style="position: sticky; top: 0"
              >
                {{ i }}
              </th>
            </tr>
            <tr v-for="(i, i_) in transaction?.transaction_items ?? []">
              <td class="border border-dark p-0 m-0">{{ i_ + 1 }}</td>
              <td class="border border-dark p-0 m-0">
                <VueSelect
                  :options="items"
                  :getOptionLabel="(i:any) => `#${i?.id}: ${i?.name}`"
                  :modelValue="
                    items.find((ix) => `${ix?.id}` === `${i?.item_id}`)
                  "
                  @update:modelValue="(ix: any) => {
                    i.item_id = ix?.id
                  }"
                />
                <!-- {{ i?.item_id }} -->
              </td>
              <td class="border border-dark p-0 m-0">
                <input
                  style="width: 75px"
                  class="form-control form-control-sm"
                  placeholder="Qty..."
                  :value="i?.qty"
                  @blur="e => {
                    if((e.target  as HTMLInputElement).value === '') {
                      return
                    }

                    if(isNaN(parseFloat((e.target  as HTMLInputElement).value))){
                      return
                    }

                    i.qty = parseFloat((e.target  as HTMLInputElement).value)
                  }"
                />
              </td>
              <td class="border border-dark p-0 m-0">
                <VueSelect
                  :options="transactionTypes"
                  :getOptionLabel="(t:any) => `${transactionTypeToJSON (transactionTypeFromJSON(t))}`"
                  :modelValue="transactionTypeFromJSON(i?.transaction_type)"
                  @update:modelValue="
                    (t) => {
                      i.transaction_type = t;
                    }
                  "
                />
                <!-- {{ transactionTypeToJSON(transactionTypeFromJSON(i?.type)) }} -->
              </td>

              <td class="border border-dark p-0 m-0">
                <VueSelect
                  :options="warehouses"
                  :getOptionLabel="(w:any) => `${w?.name}`"
                  :modelValue="
                    warehouses.find((w) => `${w?.id}` === `${i?.warehouse_id}`)
                  "
                  @update:modelValue="
                    (w) => {
                      i.warehouse_id = w?.id;
                    }
                  "
                />
                <!-- {{ i?.warehouse_id }}
                {{
                  warehouses.find((w) => `${w?.id}` === `${i?.warehouse_id}`)
                }} -->
              </td>
            </tr>
          </table>
        </div>

        <div><hr /></div>

        <div class="d-flex">
          <button
            class="btn btn-sm btn-danger px-1 py-0"
            @click="
              () => {
                transaction = null;
              }
            "
          >
            Cancel
          </button>
          <button
            v-if="!loading"
            class="btn btn-sm btn-success px-1 py-0"
            @click="
              () => {
                handleSave();
              }
            "
          >
            Save
          </button>
          <div v-else>
            <div class="spinner-border"></div>
          </div>
        </div>
      </div>
    </dialog>
    <div class="d-flex align-items-end">
      <div>Transactions</div>
      <div>
        <button
          class="btn btn-sm btn-primary px-1 py-0"
          @click="
            () => {
              transaction = { transaction_items: [] };
            }
          "
        >
          Add
        </button>
      </div>

      <div class="mx-2">
        <small><strong>From</strong></small>
        <input
          class="form-control form-control-sm"
          type="date"
          :value="from"
          @blur="
            (e) => {
              if((e.target as HTMLInputElement).value === ''){
                return
              }
              console.log(e);
            }
          "
        />
      </div>
      <div class="mx-2">
        <small><strong>To</strong></small>
        <input
          class="form-control form-control-sm"
          type="date"
          :value="to"
          @blur="
            (e) => {
              if((e.target as HTMLInputElement).value === ''){
                return
              }
              console.log(e);
            }
          "
        />
        <!-- {{ to }} -->
      </div>
    </div>
    <div
      class="border border-dark shadow shadow-md overflow-auto"
      style="height: 75vh; resize: vertical"
    >
      <table class="table table-sm" style="border-collapse: separate">
        <tr>
          <th
            class="bg-dark text-light p-0 m-0"
            style="position: sticky; top: 0"
            v-for="h in [
              '#',
              'ID',
              'Action',
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
        <tr v-for="(t, i) in transactions">
          <td class="border border-dark p-0 m-0">{{ i + 1 }}</td>
          <td class="border border-dark p-0 m-0">#{{ t?.id }}</td>

          <td class="border border-dark p-0 m-0">
            <div>
              <button
                class="btn btn-sm btn-primary px-1 py-0"
                @click="
                  () => {
                    transaction = t;
                  }
                "
              >
                Edit
              </button>
            </div>
          </td>

          <td class="border border-dark p-0 m-0">
            {{ t?.transaction_items?.length }}
          </td>
          <td class="border border-dark p-0 m-0">
            {{
              [
                ...new Set(
                  t?.transaction_items?.map((i: any) =>
                    transactionTypeToJSON(
                      transactionTypeFromJSON(i?.transaction_type)
                    )
                  )
                ),
              ].join(",")
            }}
          </td>
          <td class="border border-dark p-0 m-0"></td>
          <td class="border border-dark p-0 m-0">
            {{
              (() => {
                try {
                  return Intl.DateTimeFormat("en-US", {
                    dateStyle: "short",
                    timeStyle: "short",
                  }).format(new Date(t?.created_at ?? ""));
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
                  }).format(new Date(t?.updated_at ?? ""));
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
