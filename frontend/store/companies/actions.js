import types from "./mutation-types";

export default {
  async setCompanies({ commit }) {
    await fetch("/api/faculties/wydzial-techniczny/companies.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_COMPANIES, data);
      });
  },
  async setFilters({ commit }) {
    await fetch("/api/faculties/wydzial-techniczny/filters.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_FILTERS, data);
      });
  },
  setFaculties({ commit }) {
    fetch("/api/faculties/faculties.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_FACULTIES, data);
      });
  },
  setDocuments({ commit }) {
    fetch("/api/faculties/wydzial-techniczny/documents/documents.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_DOCUMENTS, data);
      });
  },
  setTags({ commit }) {
    fetch("/api/faculties/wydzial-techniczny/filters.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_TAGS, data.tags);
      });
  },
  async setCompaniesMerged({ getters, dispatch, commit }) {
    await dispatch("setCompanies");
    await dispatch("setFilters");
    let companies = getters.getCompanies;
    let filters = getters.getFilters;

    const lookups = Object.fromEntries(
      Object.entries(filters).map(([key, data]) => [
        key,
        data.reduce((acc, i) => ({ ...acc, [i.id]: i.name }), {}),
      ])
    );
    const result = companies.map((i) => ({
      ...i,
      address: {
        ...i.address,
        cityName: lookups.city[i.address.cityId],
        countryName: lookups.country[i.address.countryId],
      },
      filterData: {
        ...i.filterData,
        specializationName: lookups.specialization[i.filterData.specialization],
        tags: i.filterData.tags.map((t) => lookups.tags[t]),
      },
    }));
    commit(types.SET_COMPANIES_MERGED, result);
  },
};
