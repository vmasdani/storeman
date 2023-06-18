export const fetchTenant = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${window.location.origin}/api/tenants/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return await resp.json();
  } catch (e) {
    return null;
  }
};
