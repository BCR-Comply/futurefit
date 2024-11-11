<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $table = 'inspections';
    use HasFactory;


    public $timestamps = false;

    function form()
    {
        return $this->belongsTo(Form::class, 'fk_forms_id', 'forms_id');
    }

    function property()
    {
        return $this->belongsTo(Property::class, 'fk_property_id');
    }

    function build_details()
    {
        return $this->hasOne(BuildingDetails::class, 'fk_inspection_id');
    }

    function wall_insulation()
    {
        return $this->hasOne(WallInsulation::class, 'fk_inspection_id');
    }

    function external_insulation1()
    {
        return $this->hasOne(ExternalInsolution1::class, 'fk_inspection_id');
    }

    function external_insulation2()
    {
        return $this->hasOne(ExternalInsolution2::class, 'fk_inspection_id');
    }

    function attic_insulation()
    {
        return $this->hasOne(AtticInsolution::class, 'fk_inspection_id');
    }

    function heating_upgrade()
    {
        return $this->hasOne(HeatingUpgrade::class, 'fk_inspection_id');
    }

    function grand_total()
    {
        return $this->hasOne(GrandTotal::class, 'fk_inspection_id');
    }

    function grant_and_credits()
    {
        return $this->hasOne(GrantAndCredit::class, 'fk_inspection_id');
    }

    function additional_photo_and_note()
    {
        return $this->hasOne(AdditionalPhotoNote::class, 'fk_inspection_id');
    }

    function additional_drawing_and_photo()
    {
        return $this->hasOne(AdditionalDrawing::class, 'fk_inspection_id');
    }

    function addtitional_building_detail()
    {
        return $this->hasOne(AdditionalBuildingDetail::class, 'fk_inspection_id');
    }

    function oss_cost()
    {
        return $this->hasOne(OssCost::class, 'fk_inspection_id');
    }
    function oss_additional()
    {
        return $this->hasOne(OssAdditionalCost::class, 'fk_inspection_id');
    }
    function fuel_cost()
    {
        return $this->hasOne(FuelSave::class, 'fk_inspection_id');
    }
    function housing_cost()
    {
        return $this->hasOne(HousingSave::class, 'fk_inspection_id');
    }
    function fuel_template()
    {
        return $this->hasMany(FuelTemplate::class, 'fk_inspection_id');
    }
    function housing_template()
    {
        return $this->hasMany(HousingTemplate::class, 'fk_inspection_id');
    }

    function oss_template()
    {
        return $this->hasMany(OssTemplate::class, 'fk_inspection_id');
    }
    function quotation()
    {
        return $this->hasOne(OssTemplate::class, 'fk_inspection_id', 'id');
    }
    function bre_photo_inspection_items()
    {
        return $this->hasMany(BrePhotoInspectionItem::class, 'fk_inspection_id');
    }
    function bre_snag()
    {
        return $this->hasMany(SnagRecord::class, 'fk_inspection_id','id');
    }
    function cqa_photo_inspection_items()
    {
        return $this->hasMany(CqaPhotoInspectionItem::class, 'fk_inspection_id');
    }

    function photo_inspection_items()
    {
        return $this->hasMany(PhotoInspectionItem::class, 'fk_inspection_id');
    }

    function ws_Additional_property_detail()
    {
        return $this->hasOne(WsAdditionalPropertyDetail::class, 'fk_inspection_id');
    }

    function ws_building_details()
    {
        return $this->hasOne(WsBuildingDetail::class, 'fk_inspection_id');
    }

    function ws_building_type()
    {
        return $this->hasOne(WsBuildingType::class, 'fk_inspection_id');
    }

    function ws_condition_of_inner_leaf()
    {
        return $this->hasOne(WsConditionOfInnerLeaf::class, 'fk_inspection_id');
    }

    function ws_insulation_present_in_cavity()
    {
        return $this->hasOne(WsInsulationPresentInCavity::class, 'fk_inspection_id');
    }

    function ws_new_build_cavity()
    {
        return $this->hasOne(WsNewBuildCavity::class, 'fk_inspection_id');
    }

    function ws_services_in_the_cavity()
    {
        return $this->hasOne(WsServicesInTheCavity::class, 'fk_inspection_id');
    }

    function ws_condition_of_outer_leaf()
    {
        return $this->hasOne(WsConditionOfOuterLeaf::class, 'fk_inspection_id');
    }

    function ws_ventilation_through_the_cavity()
    {
        return $this->hasOne(WsVentilationThroughTheCavity::class, 'fk_inspection_id');
    }

    function sir_base_coat_complete()
    {
        return $this->hasOne(SirBaseCoatComplete::class, 'fk_inspection_id');
    }

    function sir_boarding_complete()
    {
        return $this->hasOne(SirBoardingComplete::class, 'fk_inspection_id');
    }

    function sir_drawings_photographs()
    {
        return $this->hasOne(SirDrawingsPhotographs::class, 'fk_inspection_id');
    }

    function sir_finish_coat_complete()
    {
        return $this->hasOne(SirFinishCoatComplete::class, 'fk_inspection_id');
    }

    function sir_job_complete()
    {
        return $this->hasOne(SirJobComplete::class, 'fk_inspection_id');
    }

    function sir_preparation_complete()
    {
        return $this->hasOne(SirPreparationComplete::class, 'fk_inspection_id');
    }

    function internal_insulation()
    {
        return $this->hasMany(InternalInsulation::class, 'fk_inspection_id');
    }

    function rs_additional_property_detail()
    {
        return $this->hasOne(RsAdditionalPropertyDetail::class,'fk_inspection_id');
    }

    function rs_building_details()
    {
        return $this->hasOne(RsBuildingDetails::class,'fk_inspection_id');
    }

    function rs_coomments_photographs()
    {
        return $this->hasOne(RsCoommentsPhotographs::class,'fk_inspection_id');
    }

    function rs_roof_conditions()
    {
        return $this->hasOne(RsRoofConditions::class,'fk_inspection_id');
    }

    function rs_roof_services()
    {
        return $this->hasOne(RsRoofServices::class,'fk_inspection_id');
    }

    function rs_roof_types()
    {
        return $this->hasOne(RsRoofTypes::class,'fk_inspection_id');
    }

    function rs_roof_ventilation()
    {
        return $this->hasOne(RsRoofVentilation::class,'fk_inspection_id');
    }

    function rs_spray_plan_for_roof()
    {
        return $this->hasOne(RsSprayPlanForRoof::class,'fk_inspection_id');
    }
    function risk_safety_form()
    {
        return $this->hasOne(RiskSafetyForm::class,'fk_inspection_id');
    }
    function pre_risk_safety_form()
    {
        return $this->hasOne(PremRiskSafetyForm::class,'fk_inspection_id');
    }
    function contract_forms()
    {
        return $this->hasOne(ContractForm::class,'fk_inspection_id');
    }
    function rams_core_ventilation()
    {
        return $this->hasOne(RAMSCoresVentilation::class,'fk_inspection_id');
    }
    function terraco_forms()
    {
        return $this->hasOne(TerrecoForm::class,'fk_inspection_id');
    }
    function toolbox_save()
    {
        return $this->hasMany(ToolBoxTalkSave::class,'fk_inspection_id');
    }
    function toolbox_person()
    {
        return $this->hasMany(ToolBoxTalkPerson::class,'fk_inspection_id');
    }
}
