<template>
  <div class="fieldContainer">
    <div class="companyIcon">
      <img class="imgIcon" src="../assets/blumilklogo.png" alt="" />
    </div>
    <span class="companyName">Nazwa Bardzo Duzej Firmy</span>
    <div class="course noselect">
      <span class="textContent">Informatyka</span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.fieldContainer {
  display: grid;
  grid-template-columns: 1.5fr 4.5fr 3fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "companyLogo companyName course";
  /* text-align: center; */
  align-items: center;
  justify-items: center;
  font-size: 14px;
  height: 50px;

  .companyIcon {
    grid-area: companyLogo;
    border-radius: 50%;
    border: 2px solid grey;
    height: 25px;
    width: 25px;

    .imgIcon {
      padding: 1px;
      border-radius: 50%;
    }
  }
  .companyName {
    grid-area: companyName;
    justify-self: center;
    text-overflow: clip;
    width: 130px;
    white-space: nowrap;
    overflow: hidden;
  }
  .course {
    background: #4e9dd7;

    grid-area: course;
    display: flex;
    height: 100%;
    justify-items: right;
    align-items: center;
  }
}
</style>
