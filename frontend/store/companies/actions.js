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
  async setCompaniesMerged({ getters, dispatch }) {
    await dispatch("setCompanies");
    await dispatch("setFilters");
    let companies = getters.getCompanies;
    let filters = getters.getFilters;
    console.log("merged", companies, filters);
  },
};
