import types from "./mutation-types";

export default {
  setCompanies({ commit }) {
    fetch("/api/faculties/wydzial-techniczny/companies.json")
      .then((data) => data.json())
      .then((data) => {
        commit(types.SET_COMPANIES, data);
      });
  },
  setFilters({ commit }) {
    fetch("/api/faculties/wydzial-techniczny/filters.json")
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
};
