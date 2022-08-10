<template>
  <div>
    <div class="fieldContainer">
      <div class="companyIcon border-2 rounded-md border-zinc-400">
        <img
          class="imgIcon"
          src="../assets/images/blumilklogo.png"
          alt="Company Logo Icon"
        />
      </div>
      <div class="companyName text-zinc-900 pl-2">
        <span>{{ companyName }}</span>
      </div>
      <div class="companyInfo text-zinc-700 pl-2">
        <div class="city">
          <img src="../assets/icons/locationIcon.svg" alt="locationicon" /><span
            >{{ course }}</span
          >
        </div>
        <div class="city">
          <img src="../assets/icons/locationIcon.svg" alt="locationicon" /><span
            >{{ location }}</span
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    companyName: {
      type: String,
      required: true,
    },
    course: {
      type: String,
      required: true,
    },
    location: {
      type: String,
      required: true,
    },
  },
};
</script>

<style lang="pcss" scoped>
.fieldContainer {
  display: grid;
  grid-template-columns: 0.3fr 2fr;
  grid-template-rows: 1fr 1fr;
  gap: 0px 0px;
  grid-template-areas:
    "companyIcon companyName"
    "companyIcon companyInfo";
  align-items: center;
  justify-items: center;
  font-size: 14px;
  padding: 5px 5px 5px 5px;

  .companyIcon {
    grid-area: companyIcon;
    height: 75px;
    width: 75px;

    .imgIcon {
      padding: 1px;
    }
  }

  .companyName {
    width: 95%;
    margin-left: 4px;
    grid-area: companyName;
    position: flex;
    justify-self: start;
    align-self: end;
    font-size: 16px;
    display: inline-block;
    overflow: hidden;

    span {
      min-width: 100%;
      display: inline-block;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
  }
  .course {
    grid-area: course;
    display: flex;
    height: 100%;
    padding: 1 10px;
    margin-left: 2em;
    justify-self: end;
    align-items: center;
    font-size: 16px;
  }
  .companyInfo {
    grid-area: companyInfo;
    justify-self: start;
    display: flex;

    div {
      display: flex;
      align-items: center;
      font-size: 12px;
    }

    div img {
      display: inline-block;
      margin-right: 6px;
    }
    .city {
      margin-right: 5px;
    }
  }
}
</style>
