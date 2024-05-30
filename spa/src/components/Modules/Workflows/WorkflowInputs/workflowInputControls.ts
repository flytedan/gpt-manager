import { WorkflowInputRoutes } from "@/routes/workflowInputRoutes";
import { useListControls } from "quasar-ui-danx";
import { ActionController } from "quasar-ui-danx/types";

export const WorkflowInputController: ActionController = useListControls("workflow-inputs", {
	label: "Workflow Inputs",
	routes: WorkflowInputRoutes
});
