import { getActions } from "@/components/Modules/ContentSources/contentSourceActions";
import { ContentSourceController } from "@/components/Modules/ContentSources/contentSourceControls";
import router from "@/router";
import { fDate, fNumber } from "quasar-ui-danx";
import { TableColumn } from "quasar-ui-danx/types";

export const columns: TableColumn[] = [
	{
		name: "name",
		label: "Name",
		align: "left",
		sortable: true,
		required: true,
		actionMenu: getActions({ menu: true }),
		onClick: (workflowInput) => ContentSourceController.activatePanel(workflowInput, "edit")
	},
	{
		name: "type",
		label: "Source Type",
		sortable: true,
		align: "left"
	},
	{
		name: "url",
		label: "URL",
		sortable: true,
		align: "left"
	},
	{
		name: "per_page",
		label: "Per Page",
		sortable: true,
		align: "left",
		format: fNumber
	},
	{
		name: "fetched_at",
		label: "Last Fetched",
		sortable: true,
		align: "left",
		format: fDate
	},
	{
		name: "workflow_inputs_count",
		label: "Workflow Inputs",
		align: "left",
		format: fNumber,
		sortable: true,
		onClick: (workflowInput) => router.push({
			name: "workflow-inputs",
			query: { filter: JSON.stringify({ content_source_id: workflowInput.id }) }
		})
	},
	{
		name: "created_at",
		label: "Created Date",
		sortable: true,
		align: "left",
		format: fDate
	}
];
