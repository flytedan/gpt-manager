import { WorkflowRunRoutes } from "@/routes/workflowRoutes";
import { ConfirmActionDialog, useActions } from "quasar-ui-danx";
import { ActionOptions } from "quasar-ui-danx/types";
import { h } from "vue";

// This is the default action options for all items
const forAllItems: ActionOptions = {
	onAction: WorkflowRunRoutes.applyAction
};

const items: ActionOptions[] = [
	{
		name: "delete",
		label: "Delete",
		class: "text-red-500",
		menu: true,
		vnode: target => h(ConfirmActionDialog, {
			action: "Delete Workflow Run",
			target,
			confirmClass: "bg-red-900"
		})
	}
];

export const { getAction, getActions } = useActions(items, forAllItems);
