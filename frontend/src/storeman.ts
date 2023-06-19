/* eslint-disable */

export const protobufPackage = "";

export enum TransactionType {
  TRANSACTION_UNRECOGNISED = 0,
  TX_SELL = 1,
  TX_STOCK_IN = 2,
  UNRECOGNIZED = -1,
}

export function transactionTypeFromJSON(object: any): TransactionType {
  switch (object) {
    case 0:
    case "TRANSACTION_UNRECOGNISED":
      return TransactionType.TRANSACTION_UNRECOGNISED;
    case 1:
    case "TX_SELL":
      return TransactionType.TX_SELL;
    case 2:
    case "TX_STOCK_IN":
      return TransactionType.TX_STOCK_IN;
    case -1:
    case "UNRECOGNIZED":
    default:
      return TransactionType.UNRECOGNIZED;
  }
}

export function transactionTypeToJSON(object: TransactionType): string {
  switch (object) {
    case TransactionType.TRANSACTION_UNRECOGNISED:
      return "TRANSACTION_UNRECOGNISED";
    case TransactionType.TX_SELL:
      return "TX_SELL";
    case TransactionType.TX_STOCK_IN:
      return "TX_STOCK_IN";
    case TransactionType.UNRECOGNIZED:
    default:
      return "UNRECOGNIZED";
  }
}

export enum BomType {
  BOM_UNRECOGNISED = 0,
  BOM_MERGE = 1,
  BOM_EXPLODE = 2,
  UNRECOGNIZED = -1,
}

export function bomTypeFromJSON(object: any): BomType {
  switch (object) {
    case 0:
    case "BOM_UNRECOGNISED":
      return BomType.BOM_UNRECOGNISED;
    case 1:
    case "BOM_MERGE":
      return BomType.BOM_MERGE;
    case 2:
    case "BOM_EXPLODE":
      return BomType.BOM_EXPLODE;
    case -1:
    case "UNRECOGNIZED":
    default:
      return BomType.UNRECOGNIZED;
  }
}

export function bomTypeToJSON(object: BomType): string {
  switch (object) {
    case BomType.BOM_UNRECOGNISED:
      return "BOM_UNRECOGNISED";
    case BomType.BOM_MERGE:
      return "BOM_MERGE";
    case BomType.BOM_EXPLODE:
      return "BOM_EXPLODE";
    case BomType.UNRECOGNIZED:
    default:
      return "UNRECOGNIZED";
  }
}
