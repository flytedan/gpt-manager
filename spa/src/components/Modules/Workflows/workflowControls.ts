import { WorkflowRoutes } from "@/routes/workflowRoutes";
import { useListControls } from "quasar-ui-danx";
import { ActionController } from "quasar-ui-danx/types";

export const WorkflowController: ActionController = useListControls("workflows", {
	label: "Workflows",
	routes: WorkflowRoutes
});
