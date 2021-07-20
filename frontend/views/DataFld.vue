<template>
  <div class="fieldContainer">
    <div class="companyIcon">
      <img class="imgIcon" src="../assets/blumilklogo.png" alt="" />
      <!-- logo or defaultcompanyicon.svg -->
    </div>
    <span class="companyName">Nazwa Bardzo Duzej Firmy</span>
    <div class="course">
      <span class="textContent">Informatyka</span>
    </div>
    <div class="tagsList textContainer">
      <span class="tags">.Net,C#,Azure,JS, tag1, tag2, tag3</span>
    </div>
    <div class="city"><span>Legnica</span></div>
    <div class="payInfo">
      <img src="../assets/paidicon.svg" alt="paidicon" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {},
};
</script>

<style>
.circle {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
}
.companyIcon {
  border-radius: 50%;
  border: 2px solid grey;
  height: 25px;
  width: 25px;
}

.imgIcon {
  padding: 1px;
  border-radius: 50%;
}

.course {
  background: #4e9dd7;
}

.fieldContainer {
  display: grid;
  grid-template-columns: 1.5fr 4.5fr 3fr 4fr 2.6fr 1.4fr;
  grid-template-rows: 1fr;
  gap: 0px 0px;
  grid-template-areas: "companyLogo companyName course tags city payInfo";
  /* text-align: center; */
  align-items: center;
  justify-items: center;
  font-size: 14px;
  height: 50px;
}
.companyIcon {
  grid-area: companyLogo;
}
.companyName {
  grid-area: companyName;
  justify-self: start;
  padding-left: 5px;
  text-overflow: clip;
  width: 130px;
  white-space: nowrap;
  overflow: hidden;
}
.course {
  grid-area: course;
  display: flex;
  height: 100%;
  /* line-height: 500%; */
  padding: 0 10px;
  justify-items: center;
  align-items: center;
}

.tagsList {
  grid-area: tags;
  font-size: 12px;
}
.city {
  grid-area: city;
  font-size: 12px;
}
.payInfo {
  grid-area: payInfo;
}

.textContainer {
  overflow: hidden;
  width: 100px;
  margin-left: 0em;
}

.textContainer .tags {
  text-align: center;
  display: inline-block; /* important */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-transition: 3.3s;
  -moz-transition: 3.3s;
  transition: 3.3s;

  -webkit-transition-timing-function: linear;
  -moz-transition-timing-function: linear;
  transition-timing-function: linear;
}

.textContainer:hover .tags {
  margin-left: -300px;
}
</style>
