import { TransactionType } from "./storeman";

export const makeDateString = (d: Date) =>
  `${d.getFullYear()}-${
    d.getMonth() + 1 < 10 ? `0${d.getMonth() + 1}` : `${d.getMonth() + 1}`
  }-${d.getDate() < 10 ? `${d.getDate()}` : `${d.getDate()}`}`;

export const transactionTypes = [
  TransactionType.TX_SELL,
  TransactionType.TX_STOCK_IN,
];