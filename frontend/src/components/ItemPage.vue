<script setup lang="ts">
import { ref } from "vue";
import { ctx } from "../main";
import { fetchItems } from "../fetchers";

const item = ref<any | null>(null);
const items = ref([]);

const priceInput = ref(0);

const fetchItemsData = async () => {
  const d = await fetchItems({ apiKey: ctx.value.apiKey ?? "" });

  if (d) {
    items.value = d;
  }
};

const handleSave = async () => {
  try {
    const resp = await fetch(`${window.location.origin}/api/items`, {
      method: "post",
      headers: { Authorization: ctx.value.apiKey ?? "" },
      body: JSON.stringify(item.value),
    });

    if (resp.status !== 200) {
      throw await resp.text();
    }

    window.location.reload();
  } catch (e) {}
};

fetchItemsData();
</script>

<template>
  <div>
    <dialog :open="item ? true : false">
      <div><strong>Add/Edit Item</strong></div>
      <div><hr /></div>
      <small><strong>Name</strong></small>
      <div>
        <input
          class="form-control form-control-sm"
          placeholder="Name..."
          :value="item?.name"
          @blur="(e) => {
            item.name = (e.target as HTMLInputElement).value
            
          }"
        />
      </div>
      <small><strong>Price History</strong></small>
      <div class="d-flex">
        <input
          class="form-control form-control-sm"
          placeholder="Insert Price..."
          @input="e =>{
            if(isNaN(parseFloat((e.target as HTMLInputElement).value))){
              return
            }

            priceInput = parseFloat((e.target as HTMLInputElement).value)
          }"
        />
        <button
          class="btn btn-sm btn-primary px-1 py-0"
          @click="
            () => {
              const newItemPrice = { price: priceInput };

              item.item_prices = item?.item_prices
                ? [...item.item_prices, newItemPrice]
                : [newItemPrice];
            }
          "
        >
          Insert
        </button>
      </div>
      <div>
        <small>{{ Intl.NumberFormat("en-US").format(priceInput) }}</small>
      </div>
      <ul>
        <li v-for="p in item?.item_prices ?? []">
          <div>
            <div>
              {{ Intl.NumberFormat("en-US").format(p?.price ?? 0) }}
              <small
                >({{
                  (() => {
                    try {
                      return Intl.DateTimeFormat("en-US", {
                        dateStyle: "short",
                        timeStyle: "short",
                      }).format(new Date(p?.created_at ?? ""));
                    } catch (e) {
                      return "";
                    }
                  })()
                }})</small
              >
            </div>
          </div>
        </li>
      </ul>

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
        <button
          class="btn btn-sm btn-success px-1 py-0"
          @click="() => handleSave()"
        >
          Save
        </button>
      </div>
    </dialog>
    <div class="d-flex">
      <div>Items</div>
      <button
        class="btn btn-sm btn-primary px-1 py-0"
        @click="
          () => {
            item = { item_prices: [] };
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
            v-for="h in ['#', 'Name', 'Last Price', 'Created', 'Updated']"
          >
            {{ h }}
          </th>
        </tr>
        <tr v-for="(i, i_) in (items as any[])">
          <td class="border border-dark p-0 m-0">{{ i_ + 1 }}</td>
          <td class="border border-dark p-0 m-0">
            <div
              class="text-primary"
              @click="
                () => {
                  item = i;
                }
              "
              style="cursor: pointer"
            >
              #{{ i?.id }}:
              {{ i?.name && i?.name !== "" ? i?.name : "No Name" }}
            </div>
          </td>
          <td class="border border-dark p-0 m-0">
            {{ Intl.NumberFormat("en-US").format(i?.last_price ?? 0) }}
          </td>
          <td class="border border-dark p-0 m-0">
            {{
              (() => {
                try {
                  return Intl.DateTimeFormat("en-US", {
                    dateStyle: "short",
                    timeStyle: "short",
                  }).format(new Date(i?.created_at ?? ""));
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
                  }).format(new Date(i?.updated_at ?? ""));
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
