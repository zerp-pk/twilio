<?php

namespace Zerp\Twilio\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\CreateSalesProposal;
use App\Events\PostSalesInvoice;
use App\Events\SentSalesProposal;
use App\Events\CreatePurchaseInvoice;
use App\Events\CreateUser;
use App\Events\CreateWarehouse;
use App\Events\CreateSalesInvoice;


use Zerp\Account\Events\CreateBankTransfer;
use Zerp\Account\Events\CreateCustomer;
use Zerp\Account\Events\CreateRevenue;
use Zerp\Account\Events\CreateVendor;

use Zerp\Appointment\Events\AppointmentStatus;
use Zerp\Appointment\Events\CreateSchedule;

use Zerp\CleaningManagement\Events\CreateCleaningBooking;
use Zerp\CleaningManagement\Events\CreateCleaningInvoice;
use Zerp\CleaningManagement\Events\CreateCleaningTeam;

use Zerp\CMMS\Events\CreateCmmsPos;
use Zerp\CMMS\Events\CreateComponent;
use Zerp\CMMS\Events\CreateLocation;
use Zerp\CMMS\Events\CreatePreventiveMaintenance;
use Zerp\CMMS\Events\CreateSupplier;
use Zerp\CMMS\Events\CreateWorkOrder;
use Zerp\CMMS\Events\CreateWorkRequest;

use Zerp\Contract\Events\CreateContract;

use Zerp\Documents\Events\CreateDocument;
use Zerp\Documents\Events\StatusChangeDocument;

use Zerp\Feedback\Events\CreateHistory;
use Zerp\Feedback\Events\CreateTemplate;

use Zerp\FixEquipment\Events\CreateFixEquipmentAccessory;
use Zerp\FixEquipment\Events\CreateFixEquipmentAsset;
use Zerp\FixEquipment\Events\CreateFixEquipmentAudit;
use Zerp\FixEquipment\Events\CreateFixEquipmentComponent;
use Zerp\FixEquipment\Events\CreateFixEquipmentConsumable;
use Zerp\FixEquipment\Events\CreateFixEquipmentLicense;
use Zerp\FixEquipment\Events\CreateFixEquipmentLocation;
use Zerp\FixEquipment\Events\CreateFixEquipmentMaintenance;

use Zerp\HospitalManagement\Events\CreateHospitalAppointment;
use Zerp\HospitalManagement\Events\CreateHospitalDoctor;
use Zerp\HospitalManagement\Events\CreateHospitalMedicine;
use Zerp\HospitalManagement\Events\CreateHospitalPatient;

use Zerp\Hrm\Events\CreateAnnouncement;
use Zerp\Hrm\Events\CreateAward;
use Zerp\Hrm\Events\CreateEvent;
use Zerp\Hrm\Events\CreateHoliday;
use Zerp\Hrm\Events\CreatePayroll;
use Zerp\Hrm\Events\UpdateLeaveStatus;

use Zerp\InnovationCenter\Events\CreateCategory;
use Zerp\InnovationCenter\Events\CreateChallenge;
use Zerp\InnovationCenter\Events\CreateCreativity;
use Zerp\Internalknowledge\Events\CreateInternalknowledgeArticle;
use Zerp\Internalknowledge\Events\CreateInternalknowledgeBook;

use Zerp\Lead\Events\CreateDeal;
use Zerp\Lead\Events\CreateLead;
use Zerp\Lead\Events\DealMoved;
use Zerp\Lead\Events\LeadConvertDeal;
use Zerp\Lead\Events\LeadMoved;

use Zerp\MachineRepairManagement\Events\CreateMachine;
use Zerp\MachineRepairManagement\Events\CreateMachineRepairRequest;

use Zerp\Notes\Events\CreateNote;

use Zerp\Sales\Events\CreateSalesMeeting;
use Zerp\Sales\Events\CreateSalesOrder;
use Zerp\Sales\Events\CreateSalesQuote;

use Zerp\School\Events\CreateAdmission;
use Zerp\School\Events\CreateClassTimetable;
use Zerp\School\Events\CreateEmployee;
use Zerp\School\Events\CreateHomework;
use Zerp\School\Events\CreateParent;
use Zerp\School\Events\CreateStudent;

use Zerp\Taskly\Events\CreateProjectBug;
use Zerp\Taskly\Events\CreateProject;
use Zerp\Taskly\Events\CreateProjectMilestone;
use Zerp\Taskly\Events\CreateProjectTask;
use Zerp\Taskly\Events\CreateTaskComment;
use Zerp\Taskly\Events\UpdateProjectTaskStage;

use Zerp\Timesheet\Events\CreateTimesheet;

use Zerp\ToDo\Events\CompleteToDo;
use Zerp\ToDo\Events\CreateToDo;

use Zerp\Twilio\Listeners\AppointmentStatusLis;
use Zerp\Twilio\Listeners\CompleteToDoLis;
use Zerp\Twilio\Listeners\CreateAdmissionLis;
use Zerp\Twilio\Listeners\CreateAnnouncementLis;
use Zerp\Twilio\Listeners\CreateAwardLis;
use Zerp\Twilio\Listeners\CreateBankTransferLis;
use Zerp\Twilio\Listeners\CreateCategoryLis;
use Zerp\Twilio\Listeners\CreateChallengeLis;
use Zerp\Twilio\Listeners\CreateClassTimetableLis;
use Zerp\Twilio\Listeners\CreateCleaningBookingLis;
use Zerp\Twilio\Listeners\CreateCleaningInvoiceLis;
use Zerp\Twilio\Listeners\CreateCleaningTeamLis;
use Zerp\Twilio\Listeners\CreateCmmsPosLis;
use Zerp\Twilio\Listeners\CreateComponentLis;
use Zerp\Twilio\Listeners\CreateContractLis;
use Zerp\Twilio\Listeners\CreateCreativityLis;
use Zerp\Twilio\Listeners\CreateCustomerLis;
use Zerp\Twilio\Listeners\CreateDealLis;
use Zerp\Twilio\Listeners\CreateDocumentsLis;
use Zerp\Twilio\Listeners\CreateEmployeeLis;
use Zerp\Twilio\Listeners\CreateEventLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentAccessoryLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentAssetLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentAuditLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentComponentLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentConsumableLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentLicenseLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentLocationLis;
use Zerp\Twilio\Listeners\CreateFixEquipmentMaintenanceLis;
use Zerp\Twilio\Listeners\CreateHistoryLis;
use Zerp\Twilio\Listeners\CreateHolidayLis;
use Zerp\Twilio\Listeners\CreateHomeworkLis;
use Zerp\Twilio\Listeners\CreateHospitalAppointmentLis;
use Zerp\Twilio\Listeners\CreateHospitalDoctorLis;
use Zerp\Twilio\Listeners\CreateHospitalMedicineLis;
use Zerp\Twilio\Listeners\CreateHospitalPatientLis;
use Zerp\Twilio\Listeners\CreateInternalknowledgeArticleLis;
use Zerp\Twilio\Listeners\CreateInternalknowledgeBookLis;
use Zerp\Twilio\Listeners\CreateLeadLis;
use Zerp\Twilio\Listeners\CreateLocationLis;
use Zerp\Twilio\Listeners\CreateMachineLis;
use Zerp\Twilio\Listeners\CreateMachineRepairRequestLis;
use Zerp\Twilio\Listeners\CreateNoteLis;
use Zerp\Twilio\Listeners\CreateParentLis;
use Zerp\Twilio\Listeners\CreatePayrollLis;
use Zerp\Twilio\Listeners\CreatePreventiveMaintenanceLis;
use Zerp\Twilio\Listeners\CreateProjectBugLis;
use Zerp\Twilio\Listeners\CreateProjectLis;
use Zerp\Twilio\Listeners\CreateProjectMilestoneLis;
use Zerp\Twilio\Listeners\CreateProjectTaskLis;
use Zerp\Twilio\Listeners\CreatePurchaseInvoiceLis;
use Zerp\Twilio\Listeners\CreateRevenueLis;
use Zerp\Twilio\Listeners\CreateSalesInvoiceLis;
use Zerp\Twilio\Listeners\CreateSalesMeetingLis;
use Zerp\Twilio\Listeners\CreateSalesOrderLis;
use Zerp\Twilio\Listeners\CreateSalesProposalLis;
use Zerp\Twilio\Listeners\CreateSalesQuoteLis;
use Zerp\Twilio\Listeners\CreateScheduleLis;
use Zerp\Twilio\Listeners\CreateStudentLis;
use Zerp\Twilio\Listeners\CreateSupplierLis;
use Zerp\Twilio\Listeners\CreateTaskCommentLis;
use Zerp\Twilio\Listeners\CreateTemplateLis;
use Zerp\Twilio\Listeners\CreateTimesheetLis;
use Zerp\Twilio\Listeners\CreateToDoLis;
use Zerp\Twilio\Listeners\CreateUserLis;
use Zerp\Twilio\Listeners\CreateVendorLis;
use Zerp\Twilio\Listeners\CreateVisitorLis;
use Zerp\Twilio\Listeners\CreateVisitPurposeLis;
use Zerp\Twilio\Listeners\CreateWarehouseLis;
use Zerp\Twilio\Listeners\CreateWoocommerceProductLis;
use Zerp\Twilio\Listeners\CreateWorkOrderLis;
use Zerp\Twilio\Listeners\CreateWorkRequestLis;
use Zerp\Twilio\Listeners\CreateZoomMeetingLis;
use Zerp\Twilio\Listeners\DealMovedLis;
use Zerp\Twilio\Listeners\LeadConvertDealLis;
use Zerp\Twilio\Listeners\LeadMovedLis;
use Zerp\Twilio\Listeners\PostSalesInvoiceLis;
use Zerp\Twilio\Listeners\SentSalesProposalLis;
use Zerp\Twilio\Listeners\StatusChangeDocumentLis;
use Zerp\Twilio\Listeners\UpdateLeaveStatusLis;
use Zerp\Twilio\Listeners\UpdateProjectTaskStageLis;

use Zerp\VisitorManagement\Events\CreateVisitor;
use Zerp\VisitorManagement\Events\CreateVisitPurpose;

use Zerp\WordpressWoocommerce\Events\CreateWoocommerceProduct;

use Zerp\ZoomMeeting\Events\CreateZoomMeeting;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CreateUser::class                     => [
            CreateUserLis::class,
        ],
        CreateSalesInvoice::class             => [
            CreateSalesInvoiceLis::class
        ],
        PostSalesInvoice::class               => [
            PostSalesInvoiceLis::class
        ],
        CreateSalesProposal::class            => [
            CreateSalesProposalLis::class
        ],
        SentSalesProposal::class              => [
            SentSalesProposalLis::class
        ],
        CreateBankTransfer::class             => [
            CreateBankTransferLis::class
        ],
        CreatePurchaseInvoice::class          => [
            CreatePurchaseInvoiceLis::class
        ],
        CreateWarehouse::class                => [
            CreateWarehouseLis::class
        ],
            // Appointment
        AppointmentStatus::class              => [
            AppointmentStatusLis::class
        ],
        CreateSchedule::class                 => [
            CreateScheduleLis::class
        ],
            // CMMS
        CreateCmmsPos::class                  => [
            CreateCmmsPosLis::class
        ],
        CreateComponent::class                => [
            CreateComponentLis::class
        ],
        CreateLocation::class                 => [
            CreateLocationLis::class
        ],
        CreatePreventiveMaintenance::class    => [
            CreatePreventiveMaintenanceLis::class
        ],
        CreateSupplier::class                 => [
            CreateSupplierLis::class
        ],
        CreateWorkOrder::class                => [
            CreateWorkOrderLis::class
        ],
        CreateWorkRequest::class              => [
            CreateWorkRequestLis::class
        ],
            // contract
        CreateContract::class                 => [
            CreateContractLis::class
        ],
            // lead
        CreateDeal::class                     => [
            CreateDealLis::class
        ],
        CreateLead::class                     => [
            CreateLeadLis::class
        ],
        DealMoved::class                      => [
            DealMovedLis::class
        ],
        LeadConvertDeal::class                => [
            LeadConvertDealLis::class
        ],
        LeadMoved::class                      => [
            LeadMovedLis::class
        ],
            // Sales
        CreateSalesMeeting::class             => [
            CreateSalesMeetingLis::class
        ],
        CreateSalesQuote::class               => [
            CreateSalesQuoteLis::class
        ],
        CreateSalesOrder::class               => [
            CreateSalesOrderLis::class
        ],
            // Taskly
        CreateProjectBug::class               => [
            CreateProjectBugLis::class
        ],
        CreateProject::class                  => [
            CreateProjectLis::class
        ],
        CreateProjectMilestone::class         => [
            CreateProjectMilestoneLis::class
        ],
        CreateProjectTask::class              => [
            CreateProjectTaskLis::class
        ],
        CreateTaskComment::class              => [
            CreateTaskCommentLis::class
        ],
        UpdateProjectTaskStage::class         => [
            UpdateProjectTaskStageLis::class
        ],
            // ZoomMeeting
        CreateZoomMeeting::class              => [
            CreateZoomMeetingLis::class
        ],
            // FixEquipment
        CreateFixEquipmentAccessory::class    => [
            CreateFixEquipmentAccessoryLis::class
        ],
        CreateFixEquipmentAsset::class        => [
            CreateFixEquipmentAssetLis::class
        ],
        CreateFixEquipmentAudit::class        => [
            CreateFixEquipmentAuditLis::class
        ],
        CreateFixEquipmentComponent::class    => [
            CreateFixEquipmentComponentLis::class
        ],
        CreateFixEquipmentConsumable::class   => [
            CreateFixEquipmentConsumableLis::class
        ],
        CreateFixEquipmentLicense::class      => [
            CreateFixEquipmentLicenseLis::class
        ],
        CreateFixEquipmentMaintenance::class  => [
            CreateFixEquipmentMaintenanceLis::class
        ],
        CreateFixEquipmentLocation::class     => [
            CreateFixEquipmentLocationLis::class
        ],
            // VisitorManagement
        CreateVisitor::class                  => [
            CreateVisitorLis::class
        ],
        CreateVisitPurpose::class             => [
            CreateVisitPurposeLis::class
        ],
            // WordpressWoocommerce
        CreateWoocommerceProduct::class       => [
            CreateWoocommerceProductLis::class
        ],
            // Feedback
        CreateHistory::class                  => [
            CreateHistoryLis::class
        ],
        CreateTemplate::class                 => [
            CreateTemplateLis::class
        ],
            // School
        CreateAdmission::class                => [
            CreateAdmissionLis::class
        ],
        CreateClassTimetable::class           => [
            CreateClassTimetableLis::class
        ],
        CreateEmployee::class                 => [
            CreateEmployeeLis::class
        ],
        CreateHomework::class                 => [
            CreateHomeworkLis::class
        ],
        CreateParent::class                   => [
            CreateParentLis::class
        ],
        CreateStudent::class                  => [
            CreateStudentLis::class
        ],
            // CleaningManagement
        CreateCleaningBooking::class          => [
            CreateCleaningBookingLis::class
        ],
        CreateCleaningInvoice::class          => [
            CreateCleaningInvoiceLis::class
        ],
        CreateCleaningTeam::class             => [
            CreateCleaningTeamLis::class
        ],
            // MachineRepairManagement
        CreateMachine::class                  => [
            CreateMachineLis::class
        ],
        CreateMachineRepairRequest::class     => [
            CreateMachineRepairRequestLis::class
        ],
            // HospitalManagement
        CreateHospitalAppointment::class      => [
            CreateHospitalAppointmentLis::class
        ],
        CreateHospitalDoctor::class           => [
            CreateHospitalDoctorLis::class
        ],
        CreateHospitalMedicine::class         => [
            CreateHospitalMedicineLis::class
        ],
        CreateHospitalPatient::class          => [
            CreateHospitalPatientLis::class
        ],
            // Timesheet
        CreateTimesheet::class                => [
            CreateTimesheetLis::class
        ],
            // Notes
        CreateNote::class                     => [
            CreateNoteLis::class
        ],
            // Internalknowledge
        CreateInternalknowledgeArticle::class => [
            CreateInternalknowledgeArticleLis::class
        ],
        CreateInternalknowledgeBook::class    => [
            CreateInternalknowledgeBookLis::class
        ],
            // InnovationCenter
        CreateCategory::class                 => [
            CreateCategoryLis::class
        ],
        CreateChallenge::class                => [
            CreateChallengeLis::class
        ],
        CreateCreativity::class               => [
            CreateCreativityLis::class
        ],
            // ToDo
        CompleteToDo::class                   => [
            CompleteToDoLis::class
        ],
        CreateToDo::class                     => [
            CreateToDoLis::class
        ],
            // Documents
        CreateDocument::class                 => [
            CreateDocumentsLis::class
        ],
        StatusChangeDocument::class           => [
            StatusChangeDocumentLis::class
        ],
            // Account
        CreateCustomer::class                 => [
            CreateCustomerLis::class
        ],
        CreateRevenue::class                  => [
            CreateRevenueLis::class
        ],
        CreateVendor::class                   => [
            CreateVendorLis::class
        ],
            // Hrm
        CreateAnnouncement::class             => [
            CreateAnnouncementLis::class
        ],
        CreateAward::class                    => [
            CreateAwardLis::class
        ],
        CreateEvent::class                    => [
            CreateEventLis::class
        ],
        CreateHoliday::class                  => [
            CreateHolidayLis::class
        ],
        CreatePayroll::class                  => [
            CreatePayrollLis::class
        ],
        UpdateLeaveStatus::class              => [
            UpdateLeaveStatusLis::class
        ],
    ];
}
