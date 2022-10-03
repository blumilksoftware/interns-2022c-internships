import { reactive, toRef, ref, watch } from "vue";
import { getNode, createMessage } from "@formkit/core";

export default function useSteps() {
  const activeStep = ref("");
  const steps = reactive({});
  const visitedSteps = ref([]);

  watch(activeStep, (newStep, oldStep) => {
    if (oldStep && !visitedSteps.value.includes(oldStep)) {
      visitedSteps.value.push(oldStep);
    }

    visitedSteps.value.forEach((step) => {
      const node = getNode(step);
      node.walk((n) => {
        n.store.set(
          createMessage({
            key: "submitted",
            value: true,
            visible: false,
          })
        );
      });
    });
  });

  const stepPlugin = (node) => {
    if (node.props.type == "group") {
      steps[node.name] = steps[node.name] || {};

      node.on("created", () => {
        steps[node.name].valid = toRef(node.context.state, "valid");
      });

      node.on("count:errors", ({ payload: count }) => {
        steps[node.name].errorCount = count;
      });

      node.on("count:blocking", ({ payload: count }) => {
        steps[node.name].blockingCount = count;
      });

      if (!activeStep.value) {
        activeStep.value = node.name;
      }

      return false;
    }
  };

  return { activeStep, visitedSteps, steps, stepPlugin };
}
