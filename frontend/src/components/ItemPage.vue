<script setup lang="ts">
import { ref } from "vue";

const item = ref(null as any | null);
const priceInput = ref(0);
</script>

<template>
  <div>
    <dialog :open="item ? true : false">
      <div><strong>Add/Edit Item</strong></div>
      <div><hr /></div>
      <small><strong>Name</strong></small>
      <div>
        <input class="form-control form-control-sm" placeholder="Name..." />
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

              item.itemPrices = item?.itemPrices
                ? [...item.itemPrices, newItemPrice]
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
        <li v-for="p in item?.itemPrices ?? []">
          <div>
            <div>{{ Intl.NumberFormat("en-US").format(p?.price ?? 0) }}</div>
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
        <button class="btn btn-sm btn-success px-1 py-0">Save</button>
      </div>
    </dialog>
    <div class="d-flex">
      <div>Items</div>
      <button
        class="btn btn-sm btn-primary px-1 py-0"
        @click="
          () => {
            item = { itemPrices: [] };
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
      </table>
    </div>
  </div>
</template>
